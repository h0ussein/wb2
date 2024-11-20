



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>welcome to hussein website</h1>
    <form action="register.php" method="post">
    <h2>register</h2>
        <label for="username">username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <br>
        <input type="submit" name="submit">
    </form>


</body>
</html>


<?php
include "db_conn.php";
if(isset ($_POST['username']) && isset($_POST['password'])){

 

$user = validate($_POST['username']);
$pass = validate($_POST['password']);

if(empty($user)){
    header ( "Location: index.php?error= User Name is required");
    exit();
}
elseif(empty($pass)){
    header ( "Location: index.php?error=  Passwird is required");
    exit();
}
else{
    $hash= password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user_name, password) 
            VALUES ('$user', '$pass')";
        
   try{

    mysqli_query($conn, $sql);
    echo"you are regestered";

   }
   catch(mysqli_sql_exception){
    echo"the username taken";
   }


header("Location: login.php");

}
}



function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>