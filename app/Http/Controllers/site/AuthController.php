<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout()
    {
        try {
            Auth::guard('web')->logout();
            return redirect()->route('site.login');
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

}
