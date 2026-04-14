<?php
include "style/navbar.php";
include "style/sidebar.php";


   if (! isset($_GET['product'])) {
    include 'view/products/view.php';
   }
    elseif ($_GET['product'] == 'add') {
        include 'view/products/add.php';
    } elseif ($_GET['product'] == 'edit') {
        include 'view/products/edit.php';
    }

?>






<?php  include "style/footer.php"; ?>