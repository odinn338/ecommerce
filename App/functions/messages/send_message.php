<?php
session_start();
require "../connection.php";

extract($_POST);

$query ="INSERT INTO `messages`( `name`, `email`, `message`,  `about`) VALUES ('$name','$email','$message','$about')";

$run =mysqli_query($connection , $query);

if($run){
    $_SESSION['success'] = "تم إرسال الرسالة بنجاح";
    header("Location: ../../contact.php");
   
}else{
    $_SESSION['error'] = "حدث خطأ أثناء إرسال الرسالة";
    header("Location: ../../contact.php");
    
}





?>