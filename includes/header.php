<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");

 if(isset($_SESSION['username'])){               //checks if the user is loggen in, as in register.php we set the username variable once the user logs in
   $userLoggedIn = $_SESSION['username'];       // variable stores the username of the user that is currently logged in
   $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'"); //gets info about users
   $user = mysqli_fetch_array($user_details_query); // makes array of all info about the user

 }
 else{                                          //user is not logged in
   header("Location: register.php");            //as the user is not logged in it sends the user back to the registeration page
 }
?>

<html>
<head>
    <title>
        Welcome to ClgFeed!!!
    </title>
    <!-- Javascript  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- <script src= "assets/js/bootstrap.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src= "assets/js/bootbox.min.js"></script>
    <script src= "assets/js/clgbook.js"></script>
    <script src="assets/js/jquery.Jcrop.js"></script>
	  <script src="assets/js/jcrop_bits.js"></script>




    <!-- CSS -->
    <script src="https://kit.fontawesome.com/782555080c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
</head>
<body>

    <div class="top_bar">
      <div class="logo">
        <img src="assets/images/logo.png">
        <a href="index.php">ClgFeed</a>
      </div>

      <nav>
        <a href="<?php echo $userLoggedIn ?>">
          <?php echo $user['first_name']; ?>
        </a>
        <a href="#">
          <i class="fa-solid fa-house"></i>
        </a>
        <a href="#">
          <i class="fa-solid fa-envelope"></i>
        </a>
        <a href="#">
          <i class="fa-solid fa-bell"></i>
        </a>
        <a href="requests.php">
          <i class="fa-solid fa-users"></i>
        </a>
        <a href="#">
          <i class="fa-solid fa-gear"></i>
        </a>
        <a href="includes/handlers/logout.php">
          <i class="fa-solid fa-right-from-bracket"></i>
        </a>
      </nav>

    </div>

    <div class="wrapper">
