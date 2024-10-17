<x-navbar />
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Travel Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Background image for the jumbotron */
        .jumbotron {
          background-image: url('https://cdn.pixabay.com/photo/2020/02/16/04/01/lake-4852581_1280.jpg');
          background-size: cover;
          background-position: center;
          color: white;
          height: 400px;
        }
    </style>    
</head>
<body>  
     <!-- Conditionally show the jumbotron only if not viewing a single post -->
     @if (!isset($isSinglePost) || !$isSinglePost)      <!--checks if the page is not a single post, allowing the jumbotron to be shown only on the index page -->
    <div class="jumbotron text-center">
        <h1>Explore the World</h1>
        <p>Travel Stories & Guides to Amazing Destinations</p>
    </div>
    @endif
    
    <div class="container">
        @yield('content')
    </div>


    <x-footer />
</body>
</html>


