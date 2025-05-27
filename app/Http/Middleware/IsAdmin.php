<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        if (Auth::user()->role !== UserRole::Admin) {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors('شما اجازه دسترسی به پنل ادمین را ندارید.');
        }

        if ($request->routeIs('admin.login')) {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
