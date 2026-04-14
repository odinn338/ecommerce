<?php
session_start();
require "../connection.php";
$id =$_GET['id'] ;
$query ="DELETE FROM `users` WHERE id = $id";
$run = mysqli_query($connection ,$query);
if($run){
    $_SESSION['success'] = "user delete successfully ";
    header("location:../../users.php");
}


?>