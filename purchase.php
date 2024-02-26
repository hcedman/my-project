<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit;
} elseif (isset($_GET['status'])) {
    if ($_GET['status'] !== "all" && $_GET['status'] !== "inprogress" && $_GET['status'] !== "finish" &&  $_GET['status'] !== "cancel") {
        header('location:index.php');
        exit;
    }
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
        $(document).ready(function() {
            var status = $('#status').val();
            if (status == "all") {
                $('#tap1').css('border-bottom', '3px solid #021b39');
            } else if (status == "inprogress") {
                $('#tap2').css('border-bottom', '3px solid #021b39');
            } else if (status == "finish") {
                $('#tap3').css('border-bottom', '3px solid #021b39');
            } else {
                $('#tap4').css('border-bottom', '3px solid #021b39');
            }
        });
    </script>
    <style>
        #a1,
        #a2,
        #a3,
        #a4 {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
    </style>
    <title>Benz Online</title>
</head>

<body>
    <?php
    include 'partition/header.php';
    include 'partition/menu_index.php';
    require 'connect.php';
    $member_id = $_SESSION['user_id'];
    $sql_cart = $conn->query("select * from orders where member_id = $member_id");
    $count_order = $sql_cart->num_rows;
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="container-fluid container-lg bg-white" id="tap" style="margin-top:8px ;">

            <div class="row" style="text-align:center ;">
                <div class="col-3" id="tap1" style="padding:2px;"><button class="btn shadow-none" style="width:100%;"><a id="a1" href="purchase.php?status=all">ทั้งหมด</a></button></div>
                <div class="col-3" id="tap2" style="padding:2px;"><button class="btn shadow-none" style="width:100%;"><a id="a2" href="purchase.php?status=inprogress">กำลังดำเนินการ</a></button></div>
                <div class="col-3" id="tap3" style="padding:2px;"><button class="btn shadow-none" style="width:100%;"><a id="a3" href="purchase.php?status=finish">สำเร็จแล้ว</a></button></div>
                <div class="col-3" id="tap4" style="padding:2px;"><button class="btn shadow-none" style="width:100%;"><a id="a4" href="purchase.php?status=cancel">ยกเลิกแล้ว</a></button></div>
            </div>
        </div>
        <?php
        $member_id = $_SESSION['user_id'];
        $status = "all";
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status != "all") {
                $sql_order = $conn->query("select * from orders where order_status = '$status' and member_id = '$member_id'");
                // $sql_order = $conn->query("select * from orders where member_id = $member_id");
            } else {
                $sql_order = $conn->query("select * from orders where member_id = $member_id");
            }
        } else {
            $sql_order = $conn->query("select * from orders where member_id = $member_id");
        }
        ?>
        <div class="container-fluid container-lg bg-white" id="list" style="margin-top:8px; padding:3rem; padding-top:2rem; min-height: 75vh;">
            <input type="hidden" value="<?php echo $status; ?>" id="status">
            <?php
            while ($result_order = $sql_order->fetch_assoc()) {
                if ($result_order['order_status'] == "inprogress") {
                    $order_status = "กำลังดำเนินการ";
                } elseif ($result_order['order_status'] == "finish") {
                    $order_status = "สำเร็จแล้ว";
                } else {
                    $order_status = "ยกเลิกแล้ว";
                }
                $order_id = $result_order['order_id'];
                $sql_item = $conn->query("select * from orders_item where order_id = $order_id");
                $result_item = $sql_item->fetch_assoc();
                $product_id = $result_item['product_id'];
                $sql_product = $conn->query("select * from product inner join picture on product.product_id = $product_id and picture.product_id = $product_id");
                $result_product = $sql_product->fetch_assoc();
            ?>
                <div class="row" style="border-bottom:1px; margin-top:1rem; margin-bottom:1rem;">
                    <div class="col-2"><span style="font-weight:bold;">เลขที่ออเดอร์ &nbsp;<?php echo $result_order['order_id']; ?></span></div>
                    <div class="col-7"><span style="font-weight:bold;">&nbsp;<?php echo $result_product['product_name']; ?></span></div>

                    <div class="col-2" style="text-align:right ; font-weight:bold;"><span>สถานะ&nbsp;:&nbsp;<?php echo $order_status; ?></span></div>
                </div>
                <div class="row" style="border-bottom:1px; border-color:black">
                    <div class="col-2" style="border-bottom: 2px solid lightgray;"><img class=" img-thumbnail" style="height:7rem; width:7rem; margin-bottom:1rem" src="upload/<?php echo $result_product['picture_name']; ?>" alt=""></div>
                    <div class="col-10" style="text-align:right; border-bottom: 2px solid lightgray; display:flex; justify-content:right;">
                        <table class=" table-light" style="width: 18rem; height:7rem;">
                            <tr>
                                <td>ยอดคำสั่งซื้อทั้งหมด</td>
                                <td><span style="font-weight:bolder; color:crimson;"><?php echo "&#3647;" . number_format($result_order['order_total']); ?></span></td>
                            </tr>
                            <tr>
                                <td>วันที่</td>
                                <td><?php echo $result_order['order_date']; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button class="btn btn-primary"><a href="order_detail.php?order_id=<?php echo $result_order['order_id']; ?>" style="text-decoration:none; font-weight:bold; color:white" target="_blank">รายละเอียด</a></button></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </form>
    <?php include 'partition/footer.php';  ?>
</body>

</html>