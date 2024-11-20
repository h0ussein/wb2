


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login.php" method="post">
    <h3>login</h3>
    <div class="cont">
        <label for="username">Email</label><br>
        <input type="text" id="username" name="username" required><br>
        </div>
        <div class="cont">

        <label for="password">Password</label><br>
        <input type="password" id="password" name="password" required><br>
        </div>

        <div class="cont">

        <input id="submit" type="submit" name="submit">
        </div>
<br>
    </form>


</body>
</html>



<?php


include "db_conn.php";


if(isset ($_POST['username']) && isset($_POST['password'])){
    

    $user = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);



    


if(empty($user)){
    header ( "Location: index.php?error= User Name is required");
    exit();
}
else if(empty($pass)){
    header ( "Location: index.php?error=  Passwird is required");
    exit();
}

$sql = "SELECT * FROM users WHERE user_name ='$user' AND password ='$pass'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if($row ['user_name'] === $user && $row ['password'] === $pass){
        echo"Logged in!";
        $_SESSION['user_name']= $row['user_name'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id']= $row['id'];
        header("Location: home.php");
        exit();
    }
    else{
        header ("Location: login.php?error=Incorrect User name or Password");
        exit();
    }
}
else{
    header("Location: register.php");
    exit();
}

}
?>
