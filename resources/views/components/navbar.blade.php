<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
    /* Navbar logo */
    .navbar-brand {
        font-family: "Times New Roman", Times, serif;
        font-size: 1.5rem;
    }

    .dropdown{
        float: right;
        padding-right: 2%;
    }


    /*search form and dropdown */
    .navbar-form, .dropdown {
        margin-left: 1rem; /* Add a small gap */
    }

    /* search input and button */
    .navbar-form .form-control {
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }

    .navbar-form .btn {
        display: inline-block;
        vertical-align: middle;
    }

    /*dropdown button size to match other elements */
     .dropdown .btn {
        padding: 0.375rem 0.75rem;
    } 
</style>

<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="/">Travel Earthlings</a>

            <!-- Navbar Toggler (for mobile view) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left-aligned Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">View Blogs</a>
                    </li>
                </ul>

                <!-- Search Bar -->
                <form action="{{ route('posts.search') }}" method="GET" class="navbar-form search d-flex">
                    <input type="text" name="query" class="form-control me-2" placeholder="Search blogs">
                    <button type="submit" class="btn btn-outline-secondary">Search</button>
                </form>

                <!-- User Dropdown (Visible for Admins) -->
                @hasrole('super-admin|admin')
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ url('permissions/') }}">Permissions</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('roles/') }}">Roles</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
                        </li>
                    </ul>
                </div>
                @endhasrole
            </div>
        </div>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
