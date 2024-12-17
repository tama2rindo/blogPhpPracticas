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
                    <h4>Roles</h4>  
                        <a href="{{ url('roles/create') }}" class="btn btn-primary float-end">Add Role</a> 
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{  $role->id }}</td>
                                <td>{{  $role->name }}</td>
                                <td>
                                    <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-success">
                                        Add / Edit role Permission</a>

                                    @role('super-admin')    <!-- this can replace can()-->
                                    <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-success">Edit</a>
                                    @endrole   

                                    @can('delete role')
                                    <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-danger mx-2">Delete</a>
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