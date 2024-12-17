<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
     public function __construct()
     {
         $this->middleware('permission:view role', ['only' =>['index']]);
         $this->middleware('permission:create role', ['only' =>['create', 'store', 'addPermissionToRole', 'givePermissionToRole']]);
         $this->middleware('permission:update role', ['only' =>['update', 'edit']]);
         $this->middleware('permission:delete role', ['only' =>['destroy']]);
     }


    public function index(){
        $roles = Role::get();
        return view('role-permission.role.index', [   //role-permission & role are folders
            'roles' => $roles
        ]);    
    }

    public function create(){
        return view('role-permission.role.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => [
                'required', 
                'string',
                'unique:roles,name'      //table roles, name column
            ]
            ]);

            Role::create([        //here we create an instance of Role
                'name' => $request->name        
            ]);

        return redirect('roles')->with('status', 'Role created successfully');
    }

    public function edit(Role $role){
        return view('role-permission.role.edit', [
        'role' => $role
        ]);
    }

    public function update(Request $request, Role $role){
        $request->validate([
            'name' => [
                'required', 
                'string',
                'unique:roles,name,'.$role->id    
                ]
            ]);

            $role->update([        
                'name' => $request->name       
            ]);

        return redirect('roles')->with('status', 'Role updated successfully');
    }

    public function destroy($roleId){
        $role = Role::find($roleId);    //find the role by its id
        $role->delete();                //then destroy it
        return redirect('roles')->with('status', 'Role deleted successfully');        
    }

    public function addPermissionToRole($roleId){
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                            ->where('role_has_permissions.role_id', $role->id)
                            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                            ->all();

        return view('role-permission.role.add-permissions', [
            'role' => $role, 
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId){
        $request->validate([
            'permission => required'
        ]);
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status', 'Permissions added to role');
    }

}
