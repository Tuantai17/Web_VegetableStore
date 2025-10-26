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
            ->where('roles', 'admin') // <-- Chỉ lấy user có vai trò admin
            ->orderBy('user.created_at', 'DESC')
            ->paginate(5);

        return view('backend.user.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create'); // Đường dẫn tới file Blade bạn vừa tạo
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,customer', // Vai trò là admin hoặc customer
            'status' => 'required|boolean',
            'phone' => 'required|string|unique:user,phone',
        ]);

        // Tạo username nếu không có giá trị
        $username = $request->username ?: strtolower(str_replace(' ', '.', $request->name)); // Tạo username từ tên người dùng

        // Kiểm tra nếu username đã tồn tại
        if (User::where('username', $username)->exists()) {
            return redirect()->back()->with('error', 'Username đã tồn tại. Vui lòng chọn username khác.');
        }

        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'roles' => $request->role, // Lưu giá trị vai trò từ form
            'phone' => $request->phone,
            'address' => '', // Mặc định rỗng nếu không nhập
            'avatar' => '',  // Mặc định rỗng nếu không có avatar
            'username' => $username, // Gán giá trị username đã tạo
            'created_by' => Auth::id() ?? 1, // Nếu chưa đăng nhập thì để mặc định là 1
        ]);

        // 👉 Điều kiện redirect theo vai trò
        if ($request->role === 'admin') {
            return redirect()->route('user.index')->with('success', 'Thêm admin thành công!');
        } else {
            return redirect()->route('user.customer')->with('success', 'Thêm customer thành công!');
        }
    }


    // cho khách hàng
    public function customerList()
    {
        $list = User::select('user.id', 'user.name', 'user.email', 'user.status', 'user.created_at', 'user.roles')
            ->where('roles', 'customer')  // Lọc role là 'customer'
            ->orderBy('user.created_at', 'DESC')
            ->paginate(5);

        return view('backend.user.customer', compact('list'));
    }
    public function user()
    {
        $list = User::select('user.id', 'user.name', 'user.email', 'user.status', 'user.created_at', 'user.roles')
            ->where('roles', 'admin')  // Lọc role là 'customer'
            ->orderBy('user.created_at', 'DESC')
            ->paginate(5);

        return view('backend.user.admin', compact('list'));
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Lấy thông tin người dùng theo ID
        $user = User::findOrFail($id);
        // Nếu không phải admin hay customer, có thể trả về một view chung
        return view('backend.user.show', compact('user'));
    }



    public function edit(string $id)
    {
        // Chỉnh sửa thông tin người dùng
        $user = User::findOrFail($id);
        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'roles' => 'required|string|in:admin,customer', // Kiểm tra vai trò là admin hoặc customer
            'status' => 'required|boolean',
        ]);

        // Cập nhật thông tin người dùng
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->roles = $request->roles; // Lưu giá trị roles
        $user->status = $request->status;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // 👉 Điều kiện redirect theo vai trò
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

    
 // Xóa người dùng (soft delete)
    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();  // Soft delete

    return redirect()->back()->with('success', 'Trạng thái người dùng đã được thay đổi.');
    }

    // Khôi phục người dùng từ thùng rác
    public function restore($userId)
    {
        $user = User::onlyTrashed()->findOrFail($userId);
        $user->restore();  // Restore người dùng từ thùng rác

    return redirect()->back()->with('success', 'Trạng thái người dùng đã được thay đổi.');
    }

    
    
    //-----------status
    public function status($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status; // Đảo trạng thái: 1 → 0, 0 → 1
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }

























    // hoem
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
            'avatar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Xử lý upload avatar
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // Lưu vào database
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $avatarPath,
            'created_by' => 0,
            'status' => 1, // hoặc 0
        ]);


        return redirect()->route('site.login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
    public function showLoginForm()
    {
        return view('frontend.login'); // Đường dẫn đúng với view bạn đang sử dụng
    }
}
