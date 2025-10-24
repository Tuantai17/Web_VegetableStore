<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginAdminMiddleware
{
  
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.loginad');
        }
        $user = Auth::user();
        if($user->roles!='admin')
        {
            return redirect()->route('admin.loginad')->with('error','khon co quyen vao admin');

        }
        return $next($request);
    }
}