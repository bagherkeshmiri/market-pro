<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout()
    {
        try {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.show-login');
        } catch (\Exception $error) {
            dd($error->getMessage());
        }
    }

}
