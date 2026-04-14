<?php
session_start();
require '../connection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  
extract($_POST);
$errors=[];
$query = "SELECT * FROM users WHERE email='$email'";
$run_query = mysqli_query($connection, $query);
//////////////////////start validation//////////////
    if(empty($name)){
        $errors['name'] ="this field is requierd";
    }elseif(strlen($name) <3){
        $errors['name'] ="plz enter valid name";
    }elseif(is_numeric($name)){
        $errors['name'] ="plz enter valid name";
    }



    if(empty($email)){
        $errors['email'] ="this field is requierd";
    }elseif(! filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "enter  valid email";
    }elseif(mysqli_num_rows($run_query) > 0){
            header('Location: ../../users.php');
        $errors['email'] = "email already exists";
    }

    

    if(empty($password)){
        $errors['password'] = "this field is requierd";
    }elseif(strlen($password) < 6){
        $errors['password'] = "password must be at least 6 characters";
    }


    if(empty($age)){
        $errors['age'] = "this field is requierd";
    }elseif(!is_numeric($age)){
        $errors['age'] = "age must be number";
    }elseif($age < 12 || $age >60){
        $errors['age'] = "age must be between 12 and 60";
    }

  
    
    if(empty($gender)){
        $errors['gender'] = "gender is required";
    }

//////////////////////end validation//////////////



    
    if(empty($errors)){
        
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query ="INSERT INTO 
        `users`( `name`, `email`, `password`, `age`, `gender`) 
        VALUES
         ('$name','$email','$password','$age','$gender')";
        $run = mysqli_query($connection, $query);
        if($run){
            $_SESSION['success'] = "$name added successfully";
            header('Location: ../../index.php');
        } 




    }else{
        $_SESSION['errors'] =$errors;
        header('Location: ../../signup.php');
        // echo '<pre>';
        // print_r($errors);
    }












}else {
    // If not a POST request, redirect to the add user form
    header('Location:../../signup.php');

}
