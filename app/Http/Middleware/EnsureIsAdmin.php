<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {

            if (Auth::guard('admin')->user()->type == UserType::Admin) {
                return $next($request);
            }

            Auth::guard('admin')->logout();
        }

        session()->flash('error', 'دسترسی غیر مجاز');
        return redirect()->route('admin.login');
    }
}
