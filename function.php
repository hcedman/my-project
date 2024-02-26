<script src="script.js"></script>
<?php
require_once 'connect.php';

// Delete cart list
if(isset($_GET['delete_id'])){
    $delete_id = $_GET['delete_id'];
    $member_id = $_GET['member_id'];
    $sql_delete = $conn->query("delete from cart where cart_id = $delete_id");
    if($sql_delete){
        echo "<script>popup('success','ลบรายการสินค้าเรียบร้อย','cart.php?id=".$member_id."')</script>";
    }else{
        echo "<script>alertInto('error','เกิดข้อผิดพลาด','cart.php?id=".$member_id."')</script>";
    }
}

?>