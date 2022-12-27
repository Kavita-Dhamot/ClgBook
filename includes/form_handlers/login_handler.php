<?php

if(isset($_POST['login_button'])) { // if login button is clicked

  $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email

  $_SESSION['log_email'] = $email; //stores email into session variable
  $password = md5($_POST['log_password']); //gets password

  $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'"); //checks if username adn password exist
  $check_login_query = mysqli_num_rows($check_database_query); // either equal to 1(if username and password exist) or 0

  if($check_login_query == 1) {
    $row = mysqli_fetch_array($check_database_query); // row variables stores an array of the information in table for the given username and password
    $username = $row['username']; // gives us the value of the username

    //reopen a closed account
    $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
    if(mysqli_num_rows($user_closed_query) == 1) {
      $reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
    }

    $_SESSION['username'] = $username; //username is stored in session variable, as long as the session variable is not NILL the user is logged in
    header("Location: index.php");
    exit();
  }
  else {
    array_push($error_array, "Email or password was incorrect<br>");
  }

}

?>