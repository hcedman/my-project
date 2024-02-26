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
    if (!isset($_POST['btn_buy'])) {
        exit;
    } else {
        $i = 0;
        $member_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $cart_id = $_POST['cart_id'];
        $qty = $_POST['qty'];
        foreach ($cart_id as $cart) {
            $sql_update = "update cart set quantity = ? where cart_id = ?";
            $stmt_update = $conn->stmt_init();
            $stmt_update->prepare($sql_update);
            $stmt_update->bind_param('ii', $qty[$i], $cart);
            $stmt_update->execute();
            $i++;
        }
    }
    $sql_member = $conn->query("select * from member where member_id = $member_id");
    $data_member = $sql_member->fetch_array();
    ?>
    <form action="place_order.php" method="post">
        <div class="container-fluid container-lg">
            <div style="background-color:white ; margin-top:8px; margin-bottom:8px; padding:2rem; border-top:5px solid steelblue;">
                <h3 style="margin-bottom:2rem; font-weight:bolder; color:#021b39;">ทำการสั่งซื้อ</h3>
                <h5 style="font-weight:bold ;"><i class="bi bi-geo-alt-fill"></i>&nbsp;&nbsp;ที่อยู่ในการจัดส่ง </h5>
                <span style="margin-left:2rem; font-weight:bold;"><?php echo $data_member['member_firstname'] . "&nbsp;&nbsp;" . $data_member['member_lastname'] . "&nbsp(" . $data_member['member_phone'] . ")"; ?></span>&nbsp;<a href="http://" style="text-decoration:none ; font-size:medium; font-weight:normal"><i class="bi bi-pencil-fill"></i>&nbsp; แก้ไข</a><br>
                <span style="margin-left:2rem;"><?php echo $data_member['member_address']; ?></span>
            </div>
            <div style="background-color:white ; padding:2rem;">
                <h5 style="font-weight:bold ;"><i class="bi bi-cart-fill"></i>&nbsp;&nbsp;สั่งซื้อสินค้าแล้ว</h5>
                <div class="row" style="margin-bottom:1rem ;">
                    <div class="col-8" style="font-weight:bold; margin-top:1rem;">รายการสินค้า &nbsp;<a href="cart.php?id=<?php echo $member_id ?>" style="text-decoration:none ; font-size:medium; font-weight:normal"><i class="bi bi-pencil-fill"></i>&nbsp; แก้ไข</a></div>
                    <div class="col-2" style="text-align:end ;  font-weight:bold; margin-top:1rem; ">ราคาต่อหน่วย</div>
                    <div class="col-1" style="text-align:center;font-weight:bold; margin-top:1rem; ">จำนวน</div>
                    <div class="col-1" style="text-align:end ;  font-weight:bold; margin-top:1rem; ">ราคารวม</div>
                </div>
                <?php
                $i = 0;
                $total = 0;
                $total_delivery = 0;
                $sql_cart = $conn->query("select * from product inner join cart on product.product_id = cart.product_id and cart.member_id = $member_id");
                while ($data_cart = $sql_cart->fetch_assoc()) {
                    $total += ($data_cart['product_price'] * $data_cart['quantity']);
                    $total_delivery += $data_cart['product_delivery'];
                    $i += 1;
                ?>
                    <div class="row" style="background-color:white ;">
                        <div class="col-8"><span style="margin-right:1rem ; margin-left:2rem;"><?php echo $i; ?>.</span><?php echo $data_cart['product_name'] . "<br>"; ?></div>
                        <div class="col-2" style="text-align:end ;"><?php echo "&#3647;" . number_format($data_cart['product_price']) . "<br>"; ?></div>
                        <div class="col-1" style="text-align:center ;"><?php echo number_format($data_cart['quantity']) . "<br>"; ?></div>
                        <div class="col-1" style="text-align:end ;"><?php echo "&#3647;" . number_format($data_cart['quantity'] * $data_cart['product_price']); ?></div>
                    </div>
                <?php
                }
                ?>
                <div style="margin-top:1rem ; font-weight:bold;">จำนวน<span style="margin:1rem;"><?php echo $sql_cart->num_rows; ?></span>รายการ</div>
            </div>
            <div style="background-color:white; padding:2rem; margin-top:8px">
                <h5 style="font-weight:bold ;"><i class="bi bi-credit-card-fill"></i>&nbsp;&nbsp;วิธีการชำระเงิน</h5>
                <div class="form-check" style="margin-left:2rem;">
                    <input type="radio" class="form-check-input" id="payment1" name="payment" value="1" checked>
                    <label for="check1">เก็บเงินปลายทาง</label>
                </div>
                <div class="form-check" style="margin-left:2rem;">
                    <input type="radio" class="form-check-input" id="payment2" name="payment" value="2">
                    <label for="check1">โอนผ่านบัญชีธนาคาร</label>
                </div>
                <input type="hidden" name="order_total" value="<?php echo $total_delivery + $total; ?>">
                <input type="hidden" name="order_delivery_price" value="<?php echo $total_delivery; ?>">
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
                <button type="submit" name="btn_checkout" class="btn btn-danger" style="width: 10rem; font-weight:bolder">สั่งสินค้า</button>
            </div>
    </form>
    <?php include 'partition/footer.php';  ?>
</body>

</html>