<x-navbar />

 <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create User</h4>  
                        {{-- below, the permissions/ is the route and create is the method--}}
                        <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a> 
                </div>
                <div class="card-body">
                    <form action="{{ url('users') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Roles</label>
                            <select name="roles[]" class="form-control" multiple>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button> <!-- when click submit it goes to url()-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>

 <x-footer />