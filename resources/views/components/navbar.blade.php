 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

 <style>
     .f: font-family: "Helvetica Neue",
     Helvetica,
     Arial,
     sans-serif;
 </style>

 <div>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="container-fluid">
             <a class="navbar-brand" style="font-family: "Times New Roman", Times, serif;" href="/livewire/paginaprincipal">Travel Earthlings</a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                 data-bs-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                 aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     <li class="nav-item">
                         <a class="nav-link " aria-current="page" href="/livewire/paginaprincipal">Home</a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link " href=" {{ route('register') }}">Register</a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link " href="{{ route('login') }}">Login</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link " aria-current="page" href="{{ route('posts.index') }}"> View & Create Blogs</a>
                     </li>
                 </ul>

                 <form action="{{ route('posts.search') }}" method="GET" class="navbar-form navbar-left">
                     <div class="form-group">
                         <input type="text" name="query" class="form-control" placeholder="Search blogs">
                     </div>
                     <button type="submit" class="btn btn-default">Search</button>
                 </form>

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
