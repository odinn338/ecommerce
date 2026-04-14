<?php

session_start();
require "../connection.php";
$id = $_GET['id'];

$select ="select * from products where id = $id";
$result = mysqli_query($connection ,$select);
$product = mysqli_fetch_assoc($result);
$images = $product['img'];
$images = explode('+', $images);

foreach ($images as $key => $value) {
   unlink("../../images/$value");
}





$query ="DELETE FROM `products` WHERE id =$id";
$run =mysqli_query($connection ,$query);
if($run){
    $_SESSION['success'] ="product delete successfully";
    header("location:../../products.php");
}



?>