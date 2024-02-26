<?php
session_start();
require 'connect.php';
$member_id = $_SESSION['user_id'];
$sql_member = $conn->query("select * from member where member_id = $member_id");
$result_member = $sql_member->fetch_assoc();
if (!isset($_POST['btn_checkout'])) {
    exit;
} else {
    $order_date = date("Y-m-d");
    $time_transfer = date('H:i:d');
    $status = "no";
    $sql_order = "insert into orders (  member_id, order_firstname, order_lastname, order_address, order_phone, order_payment, 
        order_date, order_date_transfer, order_time_transfer, order_total, order_delivery_price )values(?,?,?,?,?,?,?,?,?,?,?)";
    $stmt_order = $conn->stmt_init();
    $stmt_order->prepare($sql_order);
    $stmt_order->bind_param(
        'issssssssii',
        $member_id,
        $result_member['member_firstname'],
        $result_member['member_lastname'],
        $result_member['member_address'],
        $result_member['member_phone'],
        $_POST['payment'],
        $order_date,
        $order_date,
        $time_transfer,
        $_POST['order_total'],
        $_POST['order_delivery_price']
    );
    $stmt_order->execute();
    if ($stmt_order == true) {
        $last_id = mysqli_insert_id($conn);
        $sql_cart = $conn->query("select * from cart where member_id = $member_id");
        while ($result_cart = $sql_cart->fetch_assoc()) {
            $product_id = $result_cart['product_id'];
            $sql_qty = $conn->query("select product_remain from product where product_id = $product_id");
            if ($result_qty = $sql_qty->fetch_assoc()) {
                $total = $result_qty['product_remain'] - $result_cart['quantity'];
                if ($total >= 0) {
                    $sql_update = $conn->query("update product set product_remain=$total where product_id = $product_id");
                    if ($sql_update == true) {
                        $sql_order_item = "insert into orders_item (order_id, product_id, quantity)values(?,?,?)";
                        $stmt_order_item = $conn->stmt_init();
                        $stmt_order_item->prepare($sql_order_item);
                        $stmt_order_item->bind_param('iii', $last_id, $product_id, $result_cart['quantity']);
                        $stmt_order_item->execute();
                        if ($stmt_order_item == true) {
                            $sql_delete = $conn->query("delete from cart where member_id = $member_id and product_id = $product_id");
                        }
                    }
                }
            }
        }
    }
    if ($stmt_order == false or $sql_cart == false or $result_qty == false or $sql_update == false or $stmt_order_item == false) {
        $sql_cancel = $conn->query("update orders set order_status = 'cacel' where order_id = $last_id");
        // if($sql_update == false){
        //     $sql_return = $conn->query("select * from order_item where order_id = $last_id");
        //     while($result_return = $sql_cancel->fetch_assoc()){
        //         $sql_return_qty = $conn->query("update from product where product_id == $")
        //     }
        // }
        $status_order = 0;
    } else {
        $status_order = 1;
        echo "<script>window.location.href = 'result.php?order=$last_id&status=$status_order';</script>";
    }
}
