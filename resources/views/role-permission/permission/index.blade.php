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
                    <h4>Permissions</h4>  
                        {{-- below, the permissions/ is the route and create is the method--}}
                        <a href="{{ url('permissions/create') }}" class="btn btn-primary float-end">Add Permission</a> 
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
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{  $permission->id }}</td>
                                <td>{{  $permission->name }}</td>
                                <td>
                                    @can('update permission')
                                    <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="btn btn-success">Edit</a>
                                    @endcan

                                    @can('delete permission')
                                    <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="btn btn-danger mx-2">Delete</a>
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