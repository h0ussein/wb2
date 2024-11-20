<?php
include "db_conn.php";
if(isset ($_POST['username']) && isset($_POST['password'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$user = validate($_POST['username']);
$pass = validate($_POST['password']);

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

?>