<?php
session_name("FRONT_SESSION");

 session_start();
unset($_SESSION['login']);
header('location:../../index.php');

?>