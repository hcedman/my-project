<?php
session_start();
if (!isset($_SESSION['user_id']) && $_SESSION['user_level'] !== 2) {
    header('location:index.php');
    exit;
}
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
    <style>
        #link1,
        #link2,
        #link3,
        #link4 {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
    </style>

    <title>Benz Online</title>
</head>

<body>
    <?php include 'partition/header.php' ?>
    <?php include 'partition/menu_index.php' ?>
    <?php include 'partition/menu_manage.php' ?>
    <?php
    include 'connect.php';
    $sql_product = $conn->query("select * from product where product_remain < 100 order by product_id ASC LIMIT 5");
    $sql_member = $conn->query("select * from member");
    $data_member = $sql_member->fetch_assoc();
    $count_member = mysqli_num_rows($sql_member);
    $sql_request = $conn->query("select * from member where member_level = 1");
    $count_request = mysqli_num_rows($sql_request);
    $today = date("Y-m-d");
    $sql_regis = $conn->query("select * from member where member_date = $today");
    $count_regis = mysqli_num_rows($sql_regis);
    $sql_count_order = $conn->query("select count(*) as total from orders");
    $data_count_order = $sql_count_order->fetch_assoc();
    $sql_count_today = $conn->query("select count(*) as today from orders where order_date = $today");
    $data_count_today = $sql_count_today->fetch_assoc();
    $sql_count_inprogress = $conn->query("select count(*) as inprogress from orders where order_status = 'inprogress'");
    $data_count_inprogress = $sql_count_inprogress->fetch_assoc();
    ?>
    <div class=" container-fluid container-lg bg-white" style="min-height:70vh; margin-top:8px; padding: 3rem;">
        <div class="container-fluid">
            <h3 style="font-weight:bold; margin-left:1rem; margin-top:rem; margin-bottom:1rem;">ข้อมูลผู้ใช้</h3>
            <table class="table table-success table table-striped" style="width: 80%;">
                <thead>
                    <th style="text-align: center;">จำนวนผู้ใช้</th>
                    <th style="text-align: center;">ผู้ใช้ใหม่วันนี้</th>
                    <th style="text-align: center;">คำขอเพิ่มเสิทธ์</th>
                    <th style="text-align: center;">จัดการข้อมูล</th>
                </thead>
                <tbody>
                    <td style="text-align: center;"><?php echo $count_member; ?> คน</td>
                    <td style="text-align: center;"><?php echo $count_regis; ?> คน</td>
                    <td style="text-align: center;"><?php echo $count_request; ?> คน</td>
                    <td style="text-align: center;"><button class="btn btn-success"><a href="manage_member.php" style="text-decoration: none; color:white;">จ้ดการข้อมูล</a></button></td>
                </tbody>
            </table>
            <h3 style="font-weight:bold; margin-left:1rem; margin-top:2rem; margin-bottom:1rem;">ข้อมูลคำสั่งซื้อ</h3>
            <table class="table table-warning table table-striped" style="width: 80%;">
                <thead>
                    <th style="text-align: center;">คำสั้งทั้งหมด</th>
                    <th style="text-align: center;">คำสั้งซื้อวันนี้</th>
                    <th style="text-align: center;">รอดำเนินการ</th>
                    <th style="text-align: center;">จัดการข้อมูล</th>
                </thead>
                <tbody>
                    <td style="text-align: center;"><?php echo $data_count_order['total']; ?> รายการ</td>
                    <td style="text-align: center;"><?php echo $data_count_today['today']; ?> รายการ</td>
                    <td style="text-align: center;"><?php echo $data_count_inprogress['inprogress']; ?> รายการ</td>
                    <td style="text-align: center;"><button class="btn btn-success"><a href="manage_order.php" style="text-decoration: none; color:white;">จ้ดการข้อมูล</a></button></td>
                </tbody>
            </table>
            <h3 style="font-weight:bold; margin-left:1rem; margin-top:2rem; margin-bottom:1rem;">ข้อมูลสินค้า(เหลือน้อย)</h3>
            <table class="table table-primary table table-striped" style="width: 80%;">
                <thead>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวนคงเหลือ</th>
                    <th>เพิ่มสินค้า</th>
                </thead>
                <tbody>
                    <?php while ($data_product = $sql_product->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $data_product['product_id'] . "<br>"; ?></td>
                            <td><?php echo $data_product['product_name'] . "<br>"; ?></td>
                            <td><?php echo $data_product['product_remain'] . "<br>"; ?></td>
                            <td><button type="button" class="btn btn-primary"><a href="edit_product.php?product_id=<?php echo $data_product['product_id']; ?>" style="text-decoration:none; color:white;" target="_blank">จัดการ</button></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php include 'partition/footer.php'; ?>
</body>

</html>