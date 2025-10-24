<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.loginad');
    }

    public function dologin(Request $request)
    {
        // Lấy username và password từ request
        $username = $request->username;
        $password = $request->password;

        // Kiểm tra xem username là email hay username thông thường
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $data['email'] = $username;
        } else {
            $data['username'] = $username;
        }

        $data['password'] = $password;

        // Kiểm tra đăng nhập
        if (Auth::attempt($data)) {
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công');
        }

        // Nếu đăng nhập thất bại
        return back()->with('error', 'Đăng nhập thất bại');
    }




    
}
