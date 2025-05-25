<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    public function delete(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.role.index');
    }
}
