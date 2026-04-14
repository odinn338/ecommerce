<?php
session_start();
require "../connection.php";

header('Content-Type: application/json');

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // تحقق من وجود الرسالة أولاً
    $check_query = "SELECT * FROM messages WHERE id = '$id'"; // أضفت علامات التنصيص
    $check_result = mysqli_query($connection, $check_query);
    
    if(mysqli_num_rows($check_result) > 0) {
        $current = mysqli_fetch_assoc($check_result);
        
        // تحديث الحالة
        $update_query = "UPDATE messages SET view = '1' WHERE id = '$id'"; // أضفت علامات التنصيص
        $update_result = mysqli_query($connection, $update_query);
        
        if($update_result) {
            echo json_encode([
                'success' => true,
                'message' => 'تم التحديث بنجاح',
                'before' => $current['view'],
                'after' => '1',
                'affected' => mysqli_affected_rows($connection)
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'فشل التحديث',
                'error' => mysqli_error($connection)
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'الرسالة غير موجودة'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'ID مفقود أو غير صحيح'
    ]);
}

mysqli_close($connection);
?>