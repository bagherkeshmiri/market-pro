<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }
            return route('site.login');
        }
    }

    public function handle($request, \Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [config('auth.defaults.guard')] : $guards;

        foreach ($guards as $guard) {
            if (\auth()->guard($guard)->check()) {
                if ($guard === 'admin') {
                    return $next($request);
                }

                if ($guard !== 'admin') {
                    return $next($request);
                }
            }
        }

        return redirect($this->redirectTo($request));
    }
}
