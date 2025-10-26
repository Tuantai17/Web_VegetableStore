<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoAuthController extends Controller
{
    /**
     * POST /dang-ky  -> name: user.register
     * Tạo user DEMO trong session và đăng nhập ngay.
     */
    public function register(Request $req)
    {
        $data = $req->validate([
            'name'                  => 'required|string|max:100',
            'username'              => 'required|string|max:60',
            'email'                 => 'required|email',
            'password'              => 'required|string|min:4|confirmed',
            'phone'                 => 'nullable|string|max:30',
            'address'               => 'nullable|string|max:255',
            'avatar'                => 'nullable|image|max:2048',
        ]);

        // Lấy danh sách user DEMO hiện có trong session
        $users = Session::get('demo_users', []);

        // Chặn trùng username trong cùng phiên cho dễ hiểu (không dùng DB)
        if (isset($users[$data['username']])) {
            return back()->with('error', 'Username đã tồn tại trong phiên hiện tại.')->withInput();
        }

        $id = (string) Str::uuid();

        // (Tuỳ chọn) Lưu avatar vào storage công khai
        $avatarUrl = null;
        if ($req->hasFile('avatar')) {
            $path = $req->file('avatar')->store('public/demo_avatars');
            $avatarUrl = asset(str_replace('public/', 'storage/', $path)); // => /storage/demo_avatars/...
        }

        // Lưu “user” vào session
        $users[$data['username']] = [
            'id'       => $id,
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'address'  => $data['address'] ?? null,
            'avatar'   => $avatarUrl,
            'password' => Hash::make($data['password']),
        ];
        Session::put('demo_users', $users);

        // Đăng nhập ngay
        $user = new GenericUser([
            'id'       => $id,
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'avatar'   => $avatarUrl,
        ]);
        Auth::login($user);

        // Regenerate session id tăng bảo mật
        $req->session()->regenerate();

        return redirect()->route('site.home')->with('success', 'Đăng ký & đăng nhập (demo) thành công!');
    }

    /**
     * POST /dang-nhap -> name: login.store
     * Đăng nhập user DEMO đã lưu trong session.
     */
    public function login(Request $req)
    {
        $cred = $req->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $users = Session::get('demo_users', []);
        $u = $users[$cred['username']] ?? null;

        if (!$u || !Hash::check($cred['password'], $u['password'])) {
            return back()->with('error', 'Sai tài khoản hoặc mật khẩu (demo).')->withInput();
        }

        $user = new GenericUser([
            'id'       => $u['id'],
            'name'     => $u['name'],
            'username' => $u['username'],
            'email'    => $u['email'],
            'avatar'   => $u['avatar'] ?? null,
        ]);
        Auth::login($user);
        $req->session()->regenerate();

        return redirect()->route('site.home')->with('success', 'Đăng nhập (demo) thành công!');
    }

    /**
     * POST /dang-xuat -> name: logout
     */
    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('site.home')->with('success', 'Đã đăng xuất (demo).');
    }
}
