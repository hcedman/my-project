<?php
session_start();
if (!isset($_SESSION['user_id']) && $_SESSION['user_level'] !== 2) {
    header('location:index.php');
    exit;
}
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
    <script>
    </script>
    <style>

    </style>
    <title>Benz Online</title>
</head>

<body>
    <?php
    include 'partition/header.php';
    include 'partition/menu_index.php';
    require 'connect.php';
    if (!isset($_GET['order_id'])) {
        exit;
    } else {
        $order_id = $_SESSION['user_id'];
        $order_id = $_GET['order_id'];
        $sql_order = $conn->query("select * from  orders where order_id = $order_id");
        $data_order = $sql_order->fetch_assoc();
    }
    if (isset($_POST['btn_close'])) {
        echo "<script>window.close();</script>";
    }
    ?>
    <form action="" method="post">
        <div class="container-fluid container-lg">
            <div style="background-color:white ; margin-top:8px; margin-bottom:8px; padding:2rem; border-top:5px solid steelblue;">
                <h3 style="margin-bottom:2rem; font-weight:bolder; color:#021b39;">ข้อมูลรายการสั่งซื้อที่ <?php echo $order_id; ?></h3>
                <h5 style="font-weight:bold ;"><i class="bi bi-geo-alt-fill"></i>&nbsp;&nbsp;ที่อยู่ในการจัดส่ง </h5>
                <span style="margin-left:2rem;"><?php echo $data_order['order_firstname'] . "&nbsp;&nbsp;" . $data_order['order_lastname'] . "&nbsp(" . $data_order['order_phone'] . ")"; ?><br>
                    <span style="margin-left:2rem;"><?php echo $data_order['order_address']; ?></span>
            </div>
            <div style="background-color:white ; padding:2rem;">
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
                        <div class="col-8" style="padding-left:3rem ;"><?php echo $number . ".&nbsp" . $data_item['product_name']; ?> &nbsp;</div>
                        <div class="col-2" style="text-align:end ;"><?php echo "&#3647;" . number_format($data_item['product_price']); ?></div>
                        <div class="col-1" style="text-align:center ;"><?php echo number_format($data_item['quantity']); ?></div>
                        <div class="col-1" style="text-align:end ;"><?php echo "&#3647;" . number_format($sum_item); ?></div>
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
                <button type="submit" name="btn_close" class="btn btn-danger" style="width: 10rem; font-weight:bolder">ปิด</button>
            </div>
    </form>
    <?php include 'partition/footer.php';  ?>
</body>

</html>