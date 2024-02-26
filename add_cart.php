<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
} else {
    require_once 'connect.php';
    $member_id = $_SESSION['user_id'];
    $product_id = $_GET['product_id'];
    $quantity = $_GET['quantity'];
    $sql_check = "select cart_id from cart where member_id = $member_id and product_id = $product_id";
    $stmt_check = $conn->query($sql_check);
    if ($result_check = $stmt_check->fetch_assoc()) {
        $cart_id =  $result_check['cart_id'];
        $sql_cart = "replace into cart value (?, ?, ?, ?)";
        $data_cart = array($cart_id, $member_id, $product_id, $quantity);
        $stmt_cart = $conn->prepare($sql_cart);
        $stmt_cart->execute($data_cart);
    } else {
        $sql_cart = "insert into cart (member_id, product_id, quantity) values (?,?,?)";
        $data_cart = array($member_id, $product_id, $quantity);
        $stmt_cart = $conn->prepare($sql_cart);
        $stmt_cart->execute($data_cart);
    }
    if ($sql_cart) {
        echo "เพิ่มสินค้าเรียบร้อย";
    } else {
        echo "else";
    }
}
