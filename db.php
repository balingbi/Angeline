<?php

$hostname = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName="Mother_Earth";
$conn = mysqli_connect($hostname,$dbUser,$dbPassword,$dbName);
if(!$conn){
    die("Something went wrong;");
}
  echo"connected succesfully";
?>