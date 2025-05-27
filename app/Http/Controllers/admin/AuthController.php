<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout()
    {
        try {
            Auth::logout();
            return redirect()->route('admin.login');
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

}
