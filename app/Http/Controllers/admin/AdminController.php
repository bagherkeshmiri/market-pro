<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;

class AdminController extends Controller
{
    public function delete(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.admin.index');
    }
}
