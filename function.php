
<?php
include 'connect.php';

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


if(isset($_GET['email'])){
    $email = $_GET['email'];
    $sql_check = $conn->query("select member_email from member where member_email = '$email'");
    $count = $sql_check->num_rows;
    if($count > 0){
        echo "0";
    }else{
        echo "1";
    }
}




?>

