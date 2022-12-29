<?php

class User {
    private $user;
    private $con;

    public function_construct($con , $user) {
        $this->con = $con;
        $user_details_query = mysqli_query($con , "SELECT * FROM users WHERE username = '$user'");  //fetches the details of the user
        $this->user = mysqli_fetch_array($user_details_query);
    }

    public function_getFirstAndLastName(){
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['first_name'] . " " . $row['last_name'];
    }



}


?>
