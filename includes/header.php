<?php
 require 'config/config.php';

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
    <script src="assets/js/bootstrap.js"></script>

    <!-- CSS -->
    <script src="https://kit.fontawesome.com/782555080c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

    <div class="top_bar">
      <div class="logo">
        <img src="assets/images/logo.png"> //in case of image logo
        <a href="index.php">ClgFeed</a>
      </div>

      <nav>
        <a href="#">
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
        <a href="#">
          <i class="fa-solid fa-users"></i>
        </a>
        <a href="#">
          <i class="fa-solid fa-gear"></i>
        </a>
      </nav>

    </div>
