<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_GET['order'])) {
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

    if (isset($_GET['order'])) {
        $order = $_GET['order'];
        $status = $_GET['status'];
    } else {
        exit;
    }
    ?>
    <form action="place_order.php" method="post">
        <div class="container-fluid container-lg bg-white" style="margin-top:8px; padding-bottom:5rem;  min-height: 75vh ;">
            <div style="display:flex; justify-content:center;">
                <img src="img/thank.jpg" alt="" class=" img-thumbnail" style="border:0px; width:12rem; height:12rem; margin-top:5rem; margin-bottom:2rem; ">
            </div>
            <div style="text-align:center ;">------------------------------------------------------------------------------</div>
            <?php
            if ($status == 1) {
            ?>
                <div style="text-align:center ; font-weight:bold;">
                    <span>การสั่งซื้อเสร็จเรียบร้อย</span><br>
                    <span>ออเดอร์เลขที่&nbsp;<?php echo $order; ?></span><br>
                    <span>ขอบคุณสำหรับการสั่งซื้อสินค้าจากเรา</span><br><br>
                </div>
                <div style="text-align:center ;">
                    <button class="btn btn-danger"><a href="search.php" style="text-decoration:none ; font-weight:bold; color:white; font-weight:bold">ซื้อสินค้าต่อ</a></button>
                    <button class="btn btn-danger"><a href="purchase_member.php" style="text-decoration:none ;color:white; font-weight:bold;">ประวัติการสั่งซื้อ</a></button><br><br>
                </div>
            <?php
            }
            ?>
        </div>
    </form>
    <?php include 'partition/footer.php';  ?>
</body>

</html>