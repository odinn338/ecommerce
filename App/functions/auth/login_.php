<?php
session_name("FRONT_SESSION");
session_start();
require "../connection.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors =[];


    if(empty($email)){
        $errors['email'] = "Email is required";
                
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Invalid email or password";
    }
    
    if(empty($password)){
        $errors['password'] = "Password is required";

    }


    if(!empty($errors)){
        $_SESSION['errors'] = $errors;
        header("Location:../../login.php");
        
    }


        
        
      
    }
    
    $query = "SELECT * FROM users WHERE email='$email' ";
    $run = mysqli_query($connection,$query);
    $number_of_users = mysqli_num_rows($run);

     if($number_of_users ==1 ){
      $admin = mysqli_fetch_assoc($run);
      $password_hash = $admin['password'];
      $role = $admin['role'];
      if(password_verify($password,$password_hash)){
    
            $_SESSION['login'] =$admin;
            header("Location: ../../index.php");

    
    }else{
        header("Location: ../../login.php");
        $errors['email'] = "Invalid email or password";
       
    }
     }else{
    header("Location: ../../login.php");

}


?>



    













