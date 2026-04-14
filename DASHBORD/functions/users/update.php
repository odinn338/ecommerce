<?php
session_start();
require "../connection.php";
if($_SERVER['REQUEST_METHOD'] =="POST"){
    $id =$_GET['id'];

    extract ($_POST);
    $errors=[];


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
    }

    

    if(empty($age)){
        $errors['age'] = "this field is requierd";
    }elseif(!is_numeric($age)){
        $errors['age'] = "age must be number";
    }elseif($age < 12 || $age >60){
        $errors['age'] = "age must be between 12 and 60";
    }

    if(empty($role)){
        $errors['role'] = "role is required";
    }    
    
    if(empty($gender)){
        $errors['gender'] = "gender is required";
    }




    if(empty($errors)){
        
        // echo $name . $email . $age . $gender . $role ;

        $query ="UPDATE `users` SET `name`='$name' , `email`='$email', `age`='$age' ,`gender`='$gender',`role`='$role' WHERE id = $id";


        $run = mysqli_query($connection , $query);


        if($run){
           
            $_SESSION['success'] = "$name Edited successfully";
            header('Location: ../../users.php');
        } 




    }else{
        $_SESSION['errors'] =$errors;
        header("Location: ../../users.php?user=edit&id= $id ");
        // echo '<pre>';
        // print_r($errors);
    }







}else{
    header("location:../../users.php?user=edit&id= $id");
}

?>