<?php
session_start();
require "../connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_GET['id'];
    extract($_POST);
    $errors = [];

    // Validation
    if(empty($name)){
        $errors['name'] = "this field is required";
    }elseif(strlen($name) < 3){
        $errors['name'] = "please enter valid name";
    }

    if(empty($cat)){
        $errors['cat'] = "this field is required";
    }elseif(strlen($cat) < 2){
        $errors['cat'] = "please enter valid category";
    }

    if(empty($price)){
        $errors['price'] = "this field is required";
    }elseif(!is_numeric($price)){
        $errors['price'] = "price must be number";
    }elseif($price < 0){
        $errors['price'] = "price cannot be negative";
    }

    if(!isset($sale)){
        $sale = 0;
    }elseif(!is_numeric($sale)){
        $errors['sale'] = "sale must be number";
    }elseif($sale < 0){
        $errors['sale'] = "sale cannot be negative";
    }elseif($sale > $price && $sale != 0){
        $errors['sale'] = "sale cannot be higher than price";
    }

    if(empty($count)){
        $errors['count'] = "this field is required";
    }elseif(!is_numeric($count)){
        $errors['count'] = "count must be number";
    }elseif($count < 0){
        $errors['count'] = "count cannot be negative";
    }

    // Handle image upload
    $final_img = $old_img; // Keep old image by default

    if(isset($_FILES['img']) && $_FILES['img']['error'] == 0){
        $img_name = $_FILES['img']['name'];
        $img_tmp = $_FILES['img']['tmp_name'];
        $img_size = $_FILES['img']['size'];

        // Get file extension
        $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        // Validate image
        if(!in_array($img_ext, $allowed_extensions)){
            $errors['img'] = "only JPG, JPEG, PNG, GIF allowed";
        }elseif($img_size > 5242880){ // 5MB
            $errors['img'] = "image size must be less than 5MB";
        }else{
            // Generate unique filename
            $new_img_name = uniqid('', true) . '.' . $img_ext;
            $upload_path = '../../images/';
            
            $img_destination = $upload_path . $new_img_name;

            // Move uploaded file
            if(move_uploaded_file($img_tmp, $img_destination)){
                $final_img = $new_img_name; // Save only image name without path
                
                // Delete old image if exists and new image uploaded successfully
                if(!empty($old_img) && file_exists($upload_path . $old_img)){
                    unlink($upload_path . $old_img);
                }
            }else{
                $errors['img'] = "failed to upload image";
            }
        }
    }

    // If no errors, update the database
    if(empty($errors)){
        
        $query = "UPDATE `products` SET `name`='$name', `cat`='$cat', `price`='$price', `sale`='$sale', `count`='$count', `img`='$final_img' WHERE id = $id";

        $run = mysqli_query($connection, $query);

        if($run){
            $_SESSION['success'] = "$name edited successfully";
            header('Location: ../../products.php');
            exit();
        }
    }else{
        $_SESSION['errors'] = $errors;
        header("Location: ../../products.php?product=edit&id=$id");
        exit();
    }

}else{
    header("Location: ../../products.php");
    exit();
}
?>