<?php

$con = mysqli_connect("localhost", "root", "", "social");   //connection to our database(localhost, database username, database password, database name)

if(mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_errno();
}

$query = mysqli_query($con, "INSERT INTO test VALUES('', 'Kavita')");
?>


<html>
<head>
    <title>

    </title>
</head>
<body>
    hlooo kavs!
</body>
</html>