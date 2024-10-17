
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
      background-image: url('https://cdn.pixabay.com/photo/2020/05/18/09/53/landscape-5185471_1280.jpg');
      background-size: cover;
      background-position: center;
      color: white;
      height: 400px;
    }

    .jumbotron h1 {
      font-size: 60px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .jumbotron p {
      font-size: 24px;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
    }

    /* Background images for the columns */
    .col-sm-4 {
      color: white;
      background-size: cover;
      background-position: center;
      border-radius: 10px;
      margin-bottom: 20px;
      padding: 15px;
      position: relative;
      height: 300px;
      margin-right: 5px;
      /* el fex basis sive para aumenar las cloumnas de las 3 columnas de los articulos*/
      flex-basis: 370px
    }
 

    .col-sm-4 h3 {
      color: white;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .col-sm-4 p {
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
    }

    .btn-read-more {
      position: absolute;
      bottom: 20px;
      left: 15px;
      background-color: #007BFF;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
    }

    .btn-read-more:hover {
      background-color: #0056b3;
    }

    .col-sm-4:nth-child(1) {
      background-image: url('https://cdn.pixabay.com/photo/2017/03/02/16/54/iceland-2111811_1280.jpg'); 
    }

    .col-sm-4:nth-child(2) {
      background-image: url('https://cdn.pixabay.com/photo/2018/02/28/13/22/people-3187962_1280.jpg'); 
    }

    .col-sm-4:nth-child(3) {
      background-image: url('https://cdn.pixabay.com/photo/2016/01/06/21/43/gaudi-1125018_1280.jpg'); 
    }

    /* Adjust the container padding */
    .container {
      margin-top: 30px;
    }

    
  </style>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Explore the World</h1>
  <p>Travel Stories & Guides to Amazing Destinations</p> 
</div>
  
<div class="container">
  <div class="row g-3">
  <div class="row">
    <div class="col-sm-4 ">
      <h3>Adventure in Iceland</h3>
      <p>Experience the thrill of the Viking land...</p>
      <a href="{{ route('posts.show', 11) }}" class="btn-read-more">Read More</a>
    </div>
    <div class="col-sm-4">
      <h3>Amazing Thailand</h3>
      <p>Embark on an unforgettable trip to Thailand, witness ...</p>
      <a href="{{ route('posts.show', 12) }}" class="btn-read-more">Read More</a>
    </div>
    <div class="col-sm-4">
      <h3>Discover Spain</h3>        
      <p>Immerse yourself in the vibrant culture of Spain, drink wine and...</p>
      <a href="{{ route('posts.show', 10) }}" class="btn-read-more">Read More</a>
    </div>
  </div>
  </div>
</div>

<x-footer />

</body>
</html>


