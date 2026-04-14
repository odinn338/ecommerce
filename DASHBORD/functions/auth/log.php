

<?php
session_name("BACK_SESSION");

session_start();
require "../connection.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    

      if(empty($email)){
                header("Location: ../../pages/samples/login.php");
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                header("Location: ../../pages/samples/login.php");
    }
    
    if(empty($password)){
               header("Location: ../../pages/samples/login.php");

    }


    if(!empty($errors)){
        
        header("Location: ../../pages/samples/login.php");
      
    }
    
    $query = "SELECT * FROM users WHERE email='$email' ";
    $run = mysqli_query($connection,$query);
    $number_of_users = mysqli_num_rows($run);

     if($number_of_users ==1 ){
      $admin = mysqli_fetch_assoc($run);
      $password_hash = $admin['password'];
      $role = $admin['role'];
      if(password_verify($password,$password_hash)){
        if($role == "admin" or $role =="owner"){
            $_SESSION['login'] =$admin;
            header("Location: ../../index.php");
           
        }

    
    }else{
       
        header("Location: ../../pages/samples/login.php");
    }
     }
}else{
    header("Location: ../../pages/samples/login.php");
    
}


?>



    










