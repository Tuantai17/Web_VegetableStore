<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
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
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:user,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:admin,customer',
            'status'   => 'required|boolean',
            'phone'    => 'required|string|unique:user,phone',
        ]);

        $username = $request->username ?: strtolower(str_replace(' ', '.', $request->name));
        if (User::where('username', $username)->exists()) {
            return redirect()->back()->with('error', 'Username đã tồn tại. Vui lòng chọn username khác.');
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

        if ($request->role === 'admin') {
            return redirect()->route('user.index')->with('success', 'Thêm admin thành công!');
        } else {
            return redirect()->route('user.customer')->with('success', 'Thêm customer thành công!');
        }
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
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:user,email,' . $id,
            'phone'  => 'nullable|string|max:20',
            'roles'  => 'required|string|in:admin,customer',
            'status' => 'required|boolean',
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

        if ($request->roles === 'admin') {
            return redirect()->route('user.index')->with('success', 'Cập nhật admin thành công!');
        } else {
            return redirect()->route('user.customer')->with('success', 'Cập nhật customer thành công!');
        }
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

        return redirect()->back()->with('success', 'Trạng thái người dùng đã được thay đổi.');
    }

    public function status($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    // ========================= FRONTEND REGISTER - ĐÃ FIX ========================= //
    public function registerForm()
    {
        return view('frontend.register');
    }

    public function doRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:user,username',
            'email' => 'required|email|unique:user,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // ✅ Không bắt buộc nữa
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // ✅ Tạo user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $avatarPath,
            'status' => 1,
            'roles' => 'customer',
            'created_by' => 0,
        ]);

        // ✅ Tự động đăng nhập ngay sau khi đăng ký
        Auth::login($user);

        // ✅ Chuyển hướng về trang chủ
        return redirect('/')->with('success', 'Đăng ký & đăng nhập thành công!');
    }

    public function showLoginForm()
    {
        return view('frontend.login');
    }
}
