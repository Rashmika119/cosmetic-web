<?php

$host= "localhost";
$dataBaseName = "Webproject";
$username = "root";
$password = "";

$connection = mysqli_connect($host,$username,$password,$dataBaseName);

if(!$connection){
    echo "Database connection error".mysqli_connect_error();
}

?>