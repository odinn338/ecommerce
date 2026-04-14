<?php
include "style/navbar.php";
include "style/sidebar.php";

   if (! isset($_GET['user'])) {
    include 'view/users/view.php';
   }
    elseif ($_GET['user'] == 'add') {
        include 'view/users/add.php';
   } elseif ($_GET['user'] == 'edit') {
       include 'view/users/edit.php';
   }

?>

<?php  include "style/footer.php"; ?>