<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('user.user.index');
    }
}
