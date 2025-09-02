<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\returnArgument;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::with('roles')->latest()->get();
        $employees = Employee::latest()->get();
        $roles = Role::latest()->get();
        return view('app.user-management.users', compact('employees', 'roles', 'users'));
    }

    public function permission()
    {
        return view('app.user-management.users-permissions');
    }
    /**
     * Show the form for creating a new resource.
     **/
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    //     // return $request;
    //     $user           = new User;
    //     $user->name     = $request->name;
    //     $user->email    = $request->email;
    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     return redirect()->back()->with('message', 'User Created Successfully!');
    // }

    // public function store(Request $request)
    // {
    //     //  return $request;

    //     // Validate request
    //     $request->validate([
    //         'user_id' => 'required|exists:employees,id',
    //         'role_id' => 'required',
    //     ]);

    //     // Get employee details
    //     $employee = Employee::findOrFail($request->user_id);

    //     // Create User
    //     $user = new User();
    //     $user->emp_id = $employee->id;  // linking to employee
    //     $user->name = $employee->first_name . ' ' . ($employee->last_name ?? '');
    //     $user->email = $employee->email;
    //     // $user->phone = $employee->phone ?? 'N/A';
    //     $user->phone = $employee->contact ?? '0000000000'; // fallback if null
    //     $user->password = $employee->password; // default password = phone
    //     $user->status = $request->has('status') ? 1 : 0;
    //     $user->role = $request->role_id;
    //     $user->save();


    //     // Assign Role (spatie/laravel-permission)
    //     $role = Role::with('permissions')->findOrFail($request->role_id);
    //     //      return  $role;


    //     //   $user->assignRole($role->name);
    //     //$user->givePermissionTo($role->permissions->id);
    //     $permissionIds = $role->permissions->pluck('id')->toArray();
    //     $user->givePermissionTo($permissionIds);

    //     return redirect()->back()->with('success', "$role->name Role Assign to $user->email Successfully!");
    // }


    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'user_id' => 'required|exists:employees,id',
            'role_id' => 'required',
        ]);

        // Get employee details
        $employee = Employee::findOrFail($request->user_id);

        // Create User
        $user = new User();
        $user->emp_id = $employee->id;  // linking to employee
        $user->name = $employee->first_name . ' ' . ($employee->last_name ?? '');
        $user->email = $employee->email;
        $user->phone = $employee->contact ?? '0000000000'; // fallback if null
        $user->password = $employee->password; // default password = phone
        $user->status = $request->has('status') ? 1 : 0;

        // Save role ID in users table for reference
        $user->role = $request->role_id;
        $user->save();

        // Assign Spatie Role and Permissions
        $role = Role::with('permissions')->findOrFail($request->role_id);

        // Assign role via Spatie (required for getRoleNames())
        $user->assignRole($role->name);

        // Permissions are automatically inherited via assignRole,
        // but if you want to explicitly assign them:
        // $permissionIds = $role->permissions->pluck('id')->toArray();
        // $user->givePermissionTo($permissionIds);

        return redirect()->back()->with('success', "$role->name Role Assigned to $user->email Successfully!");
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
