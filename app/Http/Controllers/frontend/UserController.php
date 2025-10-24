<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('frontend.register');
    }

   // Xử lý đăng ký

   public function register(Request $request)
   {
       $validated = $request->validate([
           'username' => 'required|string|max:255|unique:users',
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'phone' => 'required|string|max:15',
           'address' => 'required|string|max:255',
           'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
           'password' => 'required|string|min:6|confirmed',
       ]);
   
       // Lưu ảnh vào storage/public/avatars
       $avatarPath = $request->file('avatar')->store('avatars', 'public');
   
       User::create([
           'username' => $validated['username'],
           'name' => $validated['name'],
           'email' => $validated['email'],
           'phone' => $validated['phone'],
           'address' => $validated['address'],
           'avatar' => $avatarPath,
           'role' => 'customer',
           'password' => Hash::make($validated['password']),
       ]);
   
       return redirect()->route('site.loginngdung')->with('success', 'Đăng ký thành công!');
   }
   

// Xử lý đăng nhập
public function login(Request $request)
{
    $validated = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    // Đăng nhập bằng username (không phải email)
    if (Auth::attempt(['username' => $validated['username'], 'password' => $validated['password']])) {
        session()->flash('success', 'Đăng nhập thành công!');
        return redirect()->route('site.home');
    }

    // Thất bại
    return redirect()->back()->with('error', 'Sai tên đăng nhập hoặc mật khẩu.');
}
}
