<x-navbar />

 <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Role : {{ $role->name }}</h4>  
                        <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a> 
                </div>
                <div class="card-body">
                    <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <label for="">Permissions</label>

                            <div class="row">
                                @foreach($permissions as $permission)
                                <div class="col-md-2">
                                    <label>
                                        <input type="checkbox" 
                                               name="permission[]" 
                                               value="{{ $permission->name }}" 
                                               {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                        >  
                                        {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button> <!-- when click submit it goes to the form action=url()-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>

 <x-footer />