<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{
    //
    public function index()
    {
        //
        
        $permissionGroups = PermissionGroup::with('permissions')->get();
        return view('app.user-management.permissions',compact('permissionGroups'));
    }

    public function view()
    {
        //

    }


}
