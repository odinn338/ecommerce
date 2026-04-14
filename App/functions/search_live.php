<?php
header('Content-Type: application/json');
require "connection.php";

if(isset($_POST['search'])) {
    $search = mysqli_real_escape_string($connection, $_POST['search']);
    $category = isset($_POST['category']) ? mysqli_real_escape_string($connection, $_POST['category']) : 'all';
    
    // بناء الاستعلام
    $query = "SELECT * FROM products WHERE (name LIKE '%$search%' OR cat LIKE '%$search%')";
    
    // إضافة فلتر الفئة إذا لم يكن "الكل"
    if($category != 'all') {
        $query .= " AND cat = '$category'";
    }
    
    $query .= " LIMIT 8";
    
    $result = mysqli_query($connection, $query);
    
    $products = array();
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'price' => $row['price'],
                'sale' => $row['sale'],
                'img' => $row['img'],
                'cat' => $row['cat']
            );
        }
    }
    
    echo json_encode($products);
} else {
    echo json_encode(array());
}
?>