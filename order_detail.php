<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <script src="script.js"></script>
    <script src="node_modules/bootstrap-input-spinner/src/bootstrap-input-spinner.js"></script>
    <style>
    </style>
    <title>Benz Online</title>
</head>

<body>
    <?php
    include 'partition/header.php';
    include 'partition/menu_index.php';
    require 'connect.php';
    if (isset($_GET['order_id'])) {
        $order_id = $_SESSION['user_id'];
        $order_id = $_GET['order_id'];
        $sql_order = $conn->query("select * from  orders where order_id = $order_id");
        $data_order = $sql_order->fetch_assoc();
    }
    if (isset($_POST['btn_close'])) {
        echo "<script>window.close();</script>";
    }
    $link = "order_detail.php?order_id=" . $order_id . "&&cancel_id=" . $order_id;
    $link_fished = "order_detail.php?order_id=" . $order_id;
    if (isset($_GET['cancel_id'])) {
        $cancel_id = $_GET['cancel_id'];
        $sql_cancel = $conn->query("update orders SET order_status = 'cancel' where order_id = $cancel_id");
        if ($sql_cancel == true) {
            echo "<script>alertUpdate('success','ดำเนินการยกเลิกรายการเรียบร้อย','" . $link_fished . "')</script>";
            // echo "<script>alertConfirm('ยกเลิก','เมื่อรายการถูกยกเลิกจะไม่สามารถแก้ไขสถานะได้อีก','ดำเนินการยกเลิกรายการเรียบร้อย','$link')</script>";
        } else {
            echo "<script>window.close();</script>";
        }
    }
    ?>
    <div class="container-fluid container-lg">
        <div style="background-color:white ; margin-top:8px; margin-bottom:8px; padding:2rem; border-top:5px solid steelblue;">
            <h3 style="margin-bottom:2rem; font-weight:bolder; color:#021b39;">ข้อมูลรายการสั่งซื้อที่ <?php echo $order_id; ?></h3>
            <h5 style="font-weight:bold ;"><i class="bi bi-geo-alt-fill"></i>&nbsp;&nbsp;ที่อยู่ในการจัดส่ง </h5>
            <span style="margin-left:2rem;"><?php echo $data_order['order_firstname'] . "&nbsp;&nbsp;" . $data_order['order_lastname'] . "&nbsp(" . $data_order['order_phone'] . ")"; ?><br>
                <span style="margin-left:2rem;"><?php echo $data_order['order_address']; ?></span>
        </div>
        <div style="background-color:white; padding:2rem; margin-top:8px">
            <h5 style="font-weight:bold ;"><i class="bi bi-truck"></i>&nbsp;&nbsp;สถานะคำสั่งซื้อ</h5>
            <div class="form-check" style="margin-left:1rem; margin-top: 1rem;">
                <?php
                $status = $data_order['order_status'];
                if ($status == 'cancel') {
                ?>
                    <table style="width: 70% ;">
                        <tr>
                            <td style="border-bottom:darkred; border-style:solid ;"><i class="bi bi-x-circle" style="font-size:xx-large; color:darkred;"></i></td>
                            <td style="border-bottom:gray; border-style:dashed ;"><i class="bi bi-truck" style="font-size:xx-large; color:gray;"></i></td>
                            <td style="border-bottom:gray; border-style:dashed ;"><i class="bi bi-card-checklist" style="font-size:xx-large; color:gray;"></i></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 4px;"><span style="font-weight: bolder; color:darkred;">ยกเลิกคำสั่งซื้อ</span></td>
                            <td style="padding-top: 4px;"><span style="font-weight: bolder; color:gray;">อยู่ระหว่างดำเนินการ</span></td>
                            <td style="padding-top: 4px;"><span style="font-weight: bolder; color:gray;">จัดส่งเรียยบร้อย</span></td>
                            <!-- <td ><span style="font-weight: bolder; color:gray;">ยกเลิกคำสั่งซื้อ</span></td> -->
                        </tr>
                    </table>
                <?php
                } elseif ($status == 'inprogress') {
                ?>
                    <table style="width: 70% ;">
                        <tr>
                            <td style="border-bottom:forestgreen; border-style:solid ;"><i class="bi bi-receipt" style="font-size:xx-large; color:forestgreen;"></i></td>
                            <td style="border-bottom:forestgreen; border-style:solid ;"><i class="bi bi-truck" style="font-size:xx-large; color:forestgreen;"></i></td>
                            <td style="border-bottom:gray; border-style:dashed ;"><i class="bi bi-card-checklist" style="font-size:xx-large; color:gray;"></i></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 4px;"><span style="font-weight: bolder; color:forestgreen;">คำสั่งซื้อใหม่</span></td>
                            <td style="padding-top: 4px;"><span style="font-weight: bolder; color:forestgreen;">อยู่ระหว่างดำเนินการ</span></td>
                            <td style="padding-top: 4px;"><span style="font-weight: bolder; color:gray;">จัดส่งเรียยบร้อย</span></td>
                            <!-- <td ><span style="font-weight: bolder; color:gray;">ยกเลิกคำสั่งซื้อ</span></td> -->
                        </tr>
                    </table>
                <?php
                } else {
                ?>
                    <table style="width: 70% ;">
                        <tr>
                            <td style="border-bottom:forestgreen; border-style:solid ;"><i class="bi bi-receipt" style="font-size:xx-large; color:forestgreen;"></i></td>
                            <td style="border-bottom:forestgreen; border-style:solid ;"><i class="bi bi-truck" style="font-size:xx-large; color:forestgreen;"></i></td>
                            <td style="border-bottom:forestgreen; border-style:solid ;"><i class="bi bi-card-checklist" style="font-size:xx-large; color:forestgreen;"></i></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 4px;"><span style="font-weight: bolder; color:forestgreen;">คำสั่งซื้อใหม่</span></td>
                            <td style="padding-top: 4px;"><span style="font-weight: bolder; color:forestgreen;">อยู่ระหว่างดำเนินการ</span></td>
                            <td style="padding-top: 4px;"><span style="font-weight: bolder; color:forestgreen;">จัดส่งเรียยบร้อย</span></td>
                            <!-- <td ><span style="font-weight: bolder; color:gray;">ยกเลิกคำสั่งซื้อ</span></td> -->
                        </tr>
                    </table>
                <?php
                }
                ?>
            </div>
        </div>
        <div style="background-color:white ; padding:2rem; margin-top: 8px;">
            <h5 style="font-weight:bold ;"><i class="bi bi-cart-fill"></i>&nbsp;&nbsp;สั่งซื้อสินค้าแล้ว</h5>
            <div class="row" style="margin-bottom:1rem ;">
                <div class="col-8" style="font-weight:bold; margin-top:1rem;">รายการสินค้า &nbsp;</div>
                <div class="col-2" style="text-align:end ;  font-weight:bold; margin-top:1rem; ">ราคาต่อหน่วย</div>
                <div class="col-1" style="text-align:center;font-weight:bold; margin-top:1rem; ">จำนวน</div>
                <div class="col-1" style="text-align:end ;  font-weight:bold; margin-top:1rem; ">ราคารวม</div>
            </div>
            <?php
            $total = 0;
            $total_delivery = 0;
            $number = 1;
            $sql_item = $conn->query("select * from product inner join orders_item on orders_item.product_id = product.product_id and orders_item.order_id = $order_id");
            while ($data_item = $sql_item->fetch_assoc()) {
                $sum_item = $data_item['product_price'] * $data_item['quantity'];                       ?>
                <div class="row" style="margin-bottom:1rem ;">
                    <div class="col-8" style="padding-left:3rem;"><?php echo $number . ".&nbsp" . $data_item['product_name']; ?> &nbsp;</div>
                    <div class="col-2" style="text-align:end ;   "><?php echo "&#3647;" . number_format($data_item['product_price']); ?></div>
                    <div class="col-1" style="text-align:center; "><?php echo number_format($data_item['quantity']); ?></div>
                    <div class="col-1" style="text-align:end ;   "><?php echo "&#3647;" . number_format($sum_item); ?></div>
                </div>
            <?php

                $number++;
                $total += $sum_item;
                $total_delivery += $data_item['product_delivery'];
            }
            ?>
            <div style="margin-top:1rem ; font-weight:bold;">จำนวน<span style="margin:1rem;"><?php echo $number - 1; ?></span>รายการ</div>
        </div>
        <div style="background-color:white; padding:2rem; margin-top:8px">
            <h5 style="font-weight:bold ;"><i class="bi bi-credit-card-fill"></i>&nbsp;&nbsp;วิธีการชำระเงิน</h5>
            <div class="form-check" style="margin-left:1rem;">
                <span>-&nbsp<?php if ($order_payment = 1) {
                                $payment = "เก็บเงินปลายทาง";
                            } else {
                                $payment = "โอนผ่านบัญชีธนาคาร";
                            }
                            echo $payment; ?></span>
            </div>
        </div>
        <div class="col-12" style="display:flex; justify-content:right; margin-top:8px; padding:2rem; background-color:white;">

            <table style="width:15rem ; text-align:right">
                <tr>
                    <th>ยอดรวมสินค้า</th>
                    <td><?php echo "&#3647;" . number_format($total); ?></td>
                </tr>
                <tr>
                    <th>รวมค่าจัดส่ง</th>
                    <td><?php echo "&#3647;" . number_format($total_delivery); ?></td>
                </tr>
                <tr>
                    <th>รวมทั้งสิ้น</th>
                    <td><span style="font-weight:bolder; font-size:larger; color:red;"><?php echo "&#3647;" . number_format($total_delivery + $total); ?></span></td>
                </tr>
            </table>
        </div>
        <div style="background-color:whitesmoke; border-top:1px dashed darkgray ;padding:2rem; padding-top:1rem; display:flex; justify-content:right;">
            <?php if ($status != 'cancel') { ?>
                <!-- <button name="btn_cancel" onclick="alertConfirm('ยกเลิก','เมื่อรายการถูกยกเลิกจะไม่สามารถแก้ไขสถานะได้อีก','ดำเนินการยกเลิกรายการเรียบร้อย','www.google.com')" class="btn btn-warning" style="width: 10rem; font-weight:bolder; margin-right:1rem; color:white;">ยกเลิกคำสั่งซื้อ</button> -->
                <button name="btn_cancel" onclick="alertConfirm('ยกเลิกรายการ','เมื่อยกเลิกรายการแล้วจะไม่สามารถแก้ไขสถานะได้อีก','<?php echo $link ?>');" class="btn btn-warning" style="width: 10rem; font-weight:bolder; margin-right:1rem; color:white;">ยกเลิกคำสั่งซื้อ</button>

            <?php } ?>
            <button type="submit" name="btn_close" onclick="window.close()" class="btn btn-danger" style="width: 10rem; font-weight:bolder">ปิด</button>
        </div>
        <!-- <button name="btn_cancel" onclick="alertInto('success','heloooooo','index.php');" class="btn btn-warning" style="width: 10rem; font-weight:bolder; margin-right:1rem; color:white;">ยกเลิกคำสั่งซื้อ</button> -->
        <?php include 'partition/footer.php';  ?>
</body>

</html>