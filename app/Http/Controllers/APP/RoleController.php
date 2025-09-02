<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('app.user-management.roles', compact('roles'));
    }

    /**
     * Store a newly created role.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|unique:roles,name',
    //     ]);

    //     Role::create(['name' => $request->name]);

    //     return redirect()->back()->with('success', 'Role created successfully.');
    // }

    /**
     * Show form to edit role permissions.
     */
    public function edit($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissionGroups = PermissionGroup::with('permissions')->get();

        // Permissions already assigned to role
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('app.user-management.permissions', compact('role', 'permissionGroups', 'rolePermissions'));
    }

    /**
     * Update role permissions.
     */

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // get selected permission IDs
        $permissionIds = $request->permission_ids ?? [];

        // convert IDs into permission models
        $permissions = \Spatie\Permission\Models\Permission::whereIn('id', $permissionIds)->get();

        // now sync using models
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Permissions updated successfully.');
    }


    /**
     * Delete a role.
     */
    public function destroy($roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();

        return redirect()->back()->with('success', 'Role deleted successfully.');
    }
}
