<?php
session_start();
require "../connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    extract($_POST);
    $errors=[];

    // معالجة الصورة (صورة واحدة فقط)
    $file = $_FILES['img']['name'];
    $img_name = $file;
    $tmp_name = $_FILES['img']['tmp_name'];
    $size = $_FILES['img']['size'] / (1024*1024);
    $error = $_FILES['img']['error'];
    $extantion = pathinfo($img_name, PATHINFO_EXTENSION);
    $exts = ['png', 'jpg', 'jpeg'];
    
    if($error != 0){
        $errors['img'] = "plz select valid image";    
    }elseif(!in_array($extantion, $exts)){
        $errors['img'] = "plz select valid image";
    }else{
        $img_name = uniqid() . "." . $extantion;
    }

    // التحقق من اسم المنتج
    if(empty($name)){
        $errors['name'] = "this field is requierd";
    }elseif(strlen($name) < 3){
        $errors['name'] = "plz enter valid name";
    }elseif(is_numeric($name)){
        $errors['name'] = "plz enter valid name";
    }

    // التحقق من السعر
    if(empty($price)){
        $errors['price'] = "this field is requierd";
    }elseif(!is_numeric($price)){
        $errors['price'] = "plz enter valid price";
    }

    // التحقق من سعر التخفيض
    if(empty($sale)){
        $sale = 0; // إذا كان فارغ اجعله 0
    }elseif(!is_numeric($sale)){
        $errors['sale'] = "plz enter valid sale";
    }

    // التحقق من الكمية
    if(empty($count)){
        $errors['count'] = "this field is requierd";
    }elseif(!is_numeric($count)){
        $errors['count'] = "plz enter valid count";
    }

    // التحقق من الفئة
    if(empty($cat)){
        $errors['cat'] = "this field is requierd";
    }elseif(strlen($cat) < 3){
        $errors['cat'] = "plz enter valid cat";
    }elseif(is_numeric($cat)){
        $errors['cat'] = "plz enter valid cat";
    }

    // إذا لم توجد أخطاء
    if(empty($errors)){

        // رفع الصورة
        move_uploaded_file($tmp_name, "../../images/$img_name");
        
        // الإدخال في قاعدة البيانات
        $query = "INSERT INTO `products`(`name`, `price`, `sale`, `count`, `cat`, `img`) 
                  VALUES ('$name', $price, $sale, $count, '$cat', '$img_name')";

        $run = mysqli_query($connection, $query);
        
        if($run){
            $_SESSION['success'] = "product added";
            header("location:../../products.php");
        }else{
            $_SESSION['errors'] = "try again";
            header("location:../../products.php?product=add");
        }    

    }else{
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST;
        header("location:../../products.php?product=add");
    }

}else{
    header("location:../../products.php?product=add");
}
?>