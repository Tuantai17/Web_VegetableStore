<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // ====== QUẢN TRỊ (giữ lại, đã chỉnh unique theo đúng bảng) ======
    public function index()
    {
        // Lưu ý: nếu dùng alias 'user' thì tên bảng phải đúng là 'user'
        $list = User::select('user.id', 'user.name', 'user.email', 'user.status', 'user.created_at', 'user.roles')
            ->where('roles', 'admin')
            ->orderBy('user.created_at', 'DESC')
            ->paginate(5);

        return view('backend.user.index', compact('list'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(Request $request)
    {
        $table = (new User)->getTable();  // -> 'user'

        $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email', Rule::unique($table,'email')],
            'username' => ['nullable','string','max:191', Rule::unique($table,'username')],
            'password' => ['required','string','min:6','confirmed'],
            'role'     => ['required','in:admin,customer'],
            'status'   => ['required','boolean'],
            'phone'    => ['required','string', Rule::unique($table,'phone')],
        ]);

        $username = $request->username ?: strtolower(str_replace(' ', '.', $request->name));
        if (User::where('username', $username)->exists()) {
            return back()->with('error', 'Username đã tồn tại. Vui lòng chọn username khác.');
        }

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'status'     => $request->status,
            'roles'      => $request->role,
            'phone'      => $request->phone,
            'address'    => '',
            'avatar'     => '',
            'username'   => $username,
            'created_by' => Auth::id() ?? 1,
        ]);

        return $request->role === 'admin'
            ? redirect()->route('user.index')->with('success', 'Thêm admin thành công!')
            : redirect()->route('user.customer')->with('success', 'Thêm customer thành công!');
    }

    public function customerList()
    {
        $list = User::select('user.id', 'user.name', 'user.email', 'user.status', 'user.created_at', 'user.roles')
            ->where('roles', 'customer')
            ->orderBy('user.created_at', 'DESC')
            ->paginate(5);

        return view('backend.user.customer', compact('list'));
    }

    public function user()
    {
        $list = User::select('user.id', 'user.name', 'user.email', 'user.status', 'user.created_at', 'user.roles')
            ->where('roles', 'admin')
            ->orderBy('user.created_at', 'DESC')
            ->paginate(5);

        return view('backend.user.admin', compact('list'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backend.user.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $table = (new User)->getTable();

        $request->validate([
            'name'   => ['required','string','max:255'],
            'email'  => ['required','email', Rule::unique($table,'email')->ignore($id,'id')],
            'phone'  => ['nullable','string','max:20'],
            'roles'  => ['required','string','in:admin,customer'],
            'status' => ['required','boolean'],
        ]);

        $user = User::findOrFail($id);
        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->phone  = $request->phone;
        $user->roles  = $request->roles;
        $user->status = $request->status;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return $request->roles === 'admin'
            ? redirect()->route('user.index')->with('success', 'Cập nhật admin thành công!')
            : redirect()->route('user.customer')->with('success', 'Cập nhật customer thành công!');
    }

    public function trash()
    {
        $list = User::onlyTrashed()->get();
        return view('backend.user.trash', compact('list'));
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('user.trash')->with('success', 'Đã xóa vĩnh viễn người dùng.');
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect()->back()->with('success', 'Trạng thái người dùng đã được thay đổi.');
    }

    public function restore($userId)
    {
        $user = User::onlyTrashed()->findOrFail($userId);
        $user->restore();
        return redirect()->back()->with('success', 'Khôi phục người dùng thành công.');
    }

    public function status($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    // ====== FRONTEND REGISTER (LIÊN QUAN) ======
    public function registerForm()
    {
        // View bạn đang dùng
        return view('frontend.auth.register');
    }

    public function doRegister(Request $request)
    {
        $table = (new User)->getTable(); // -> 'user'

        $validated = $request->validate([
            'name'                  => ['required','string','max:255'],
            'username'              => ['required','string','max:191', Rule::unique($table,'username')],
            'email'                 => ['required','email','max:191', Rule::unique($table,'email')],
            'password'              => ['required','confirmed','min:6'],
            'phone'                 => ['required','string','max:30'],
            'address'               => ['required','string','max:255'],
            'avatar'                => ['nullable','image','mimes:jpg,jpeg,png,gif','max:2048'], // KHÔNG bắt buộc
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        User::create([
            'name'       => $validated['name'],
            'username'   => $validated['username'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
            'phone'      => $validated['phone'],
            'address'    => $validated['address'],
            'avatar'     => $avatarPath,
            'status'     => 1,
            'roles'      => 'customer',
            'created_by' => 0,
        ]);

        return redirect()->route('site.login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }
}
