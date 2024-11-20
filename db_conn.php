


<?php 

  $servername = "localhost";
  $username = "root";
  $password = "hussein";
  $dbname = "test_db";
try{
  $conn =  mysqli_connect($servername, $username, $password, $dbname);
  if ($conn) {
}
}
catch(mysqli_sql_exception){
  echo"could not connect";
}



?>