<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
     {
         $this->middleware('permission:view permission', ['only' =>['index']]);
         $this->middleware('permission:create permission', ['only' =>['create', 'store' ]]); //ensures that only users with the 'create permission' permission can access the 'create' and 'store' methods.
         $this->middleware('permission:update permission', ['only' =>['update', 'edit']]);
         $this->middleware('permission:delete permission', ['only' =>['destroy']]);
     }



    public function index(){
        $permissions = Permission::get();
        return view('role-permission.permission.index', [   //role-permission & permission are folders
            'permissions' => $permissions
        ]);    
    }

    public function create(){
        return view('role-permission.permission.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => [
                'required', 
                'string',
                'unique:permissions,name'      //table permissions, name column
            ]
            ]);

            Permission::create([        //here we create an instance of Permission
                'name' => $request->name        // => this means assign 
            ]);

        return redirect('permissions')->with('status', 'Permission created successfully');
    }

    public function edit(Permission $permission){
        return view('role-permission.permission.edit', [
        'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission){
        $request->validate([
            'name' => [
                'required', 
                'string',
                'unique:permissions,name,'.$permission->id    
                ]
            ]);

            $permission->update([        
                'name' => $request->name       
            ]);

        return redirect('permissions')->with('status', 'Permission updated successfully');
    }

    public function destroy($permissionId){
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status', 'Permission deleted successfully');        
    }
}
