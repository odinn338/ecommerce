<?php

session_start();
require "../connection.php";

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    
    $query = "DELETE FROM messages WHERE id = '$id'";
    $result = mysqli_query($connection, $query);
    
    if($result) {
        $_SESSION['success'] = "تم حذف الرسالة بنجاح";
    }
    
    header("Location: ../../messages.php");
}
?>