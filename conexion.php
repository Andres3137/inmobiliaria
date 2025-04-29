<?php

$severname= "localhost";
$username= "root";
$password = "";
$bdname = "inmobiliaria";


$conn = new mysqli($severname, $username, $password, $bdname);


if ($conn -> connect_error){
    die("connection fieled: " . $conn ->connect_error);
}

?>