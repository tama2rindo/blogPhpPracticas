<x-navbar />

 <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Role</h4>  
                        {{-- below, the permissions/ is the route and create is the method--}}
                        <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a> 
                </div>
                <div class="card-body">
                    <form action="{{ url('roles/'.$role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="">Role Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $role->name }}">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button> <!-- when click submit it goes to url()-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>

 <x-footer />