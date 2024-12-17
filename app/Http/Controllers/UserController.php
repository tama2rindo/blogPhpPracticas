<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' =>['index']]);
        $this->middleware('permission:create user', ['only' =>['create', 'store' ]]);
        $this->middleware('permission:update user', ['only' =>['update', 'edit']]);
        $this->middleware('permission:delete user', ['only' =>['destroy']]);
    }



    public function index(){
        $users = User::get();
        return view('role-permission.user.index', [
            'users' => $users
        ]);
    }

    public function create(){
        $roles = Role::pluck('name', 'name')->all();
         return view('role-permission.user.create', [
            'roles' => $roles
         ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,   //'name' is from the User model and request->name is from above
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles([$request->roles]);    //it links to select name="roles[]" in create.blade

        return redirect('/users')->with('status', 'User created successfully with roles');
   }

   public function edit(User $user){
    $roles = Role::pluck('name', 'name')->all();    //this shows which roles the users have
    $userRoles = $user->roles->pluck('name', 'name')->all(); 
    return view('role-permission.user.edit', [
        'user' =>$user,
        'roles' =>$roles,
        'userRoles' => $userRoles 
    ]);
   }

   public function update(Request $request, User $user){
    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:8|max:20',
        'roles' => 'required'
    ]);

    $data = [
            'name' => $request->name,   
            'email' => $request->email,
        ];

    if(!empty($request->password)){
        $data += [              //here I make a condition for pw and concatenate with the name & email from $data
            'password' => Hash::make($request->password),
        ];
    }

        $user-> update($data);
        $user->syncRoles([$request->roles]); 

        return redirect('/users')->with('status', 'User updated successfully with roles');
    }


    public function destroy($userId){
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status', 'User deleted successfully');

    }
}
