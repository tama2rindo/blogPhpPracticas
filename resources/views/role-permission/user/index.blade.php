<x-navbar />

    @include('role-permission.nav-links')

 <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            
            <div class="card">
                <div class="card-header">
                    <h4>Users</h4>  
                        <a href="{{ url('users/create') }}" class="btn btn-primary float-end">Add User</a> 
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)   <!-- this users refers to: $users = User::get(); at index() in UsercController-->
                            <tr>
                                <td>{{  $user->id }}</td>
                                <td>{{  $user->name }}</td>
                                <td>{{  $user->email }}</td>
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $rolename)
                                            <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                        @endforeach
                                    @endif

                                </td>
                                <td>
                                    @can('update user')
                                    <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-success">Edit</a>
                                    @endcan

                                    @can('delete user')
                                    <a href="{{ url('users/'.$user->id.'/delete') }}" class="btn btn-danger mx-2">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>    
                    </table>

                </div>
            </div>
        </div>
    </div>
 </div>

 <x-footer />