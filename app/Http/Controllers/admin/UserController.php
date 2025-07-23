<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;

class UserController extends Controller
{
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index');
    }
}
