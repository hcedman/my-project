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

        th {
            text-align: center;
            color: #021b39;
            font-weight:600 ;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        .bdr {
            border-radius: 10px;
            overflow: hidden;
            margin: auto;
            /* background-color:aliceblue; */
        }

        .btn_navy {
            background-color: #021b39;
        }
        h5{
            margin-left: 1rem; ;
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
    $sql_product = $conn->query("select * from product where product_remain < 50 order by product_id ASC LIMIT 5");
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
            <!-- <h2 style="text-align: center; font-weight:bold; margin-bottom:3rem; color:slategrey;">จัดการข้อมูลร้านค้า</h2> -->
            <h3 style="font-weight:bold; margin-left:1rem; margin-bottom:2rem; color:#021b39; text-align:center;">จัดการข้อมูลร้านค้า</h3>
            <div class="col-10" style="margin:auto auto 2rem;"  >
                <h5 style="font-weight:500; text-align:left; color:slategrey;"><i class="bi bi-person-lines-fill"></i>&nbsp;ข้อมูลผู้ใช้</h5>
                <table class="table table-light table-striped bdr" style="width: 100%;">
                    <thead>
                        <th>จำนวนผู้ใช้</th>
                        <th>ผู้ใช้ใหม่วันนี้</th>
                        <th>คำขอเพิ่มเสิทธ์</th>
                        <th>จัดการข้อมูล</th>
                    </thead>
                    <tbody>
                        <td><?php echo $count_member; ?> คน</td>
                        <td><?php echo $count_regis; ?> คน</td>
                        <td><?php echo $count_request; ?> คน</td>
                        <td><button class="btn btn_navy"><a href="manage_member.php" style="text-decoration: none; color:white;">จ้ดการข้อมูล</a></button></td>
                    </tbody>
                </table>
            </div>
            <div class="col-10" style="margin:auto auto 2rem;">
                <h5 style="font-weight:500; text-align:left; color:slategrey;"><i class="bi bi-card-list"></i>&nbsp;ข้อมูลคำสั่งซื้อ</h5>
                <table class="table table-light table-striped bdr" style="width: 100%;">
                    <thead>
                        <th>คำสั้งทั้งหมด</th>
                        <th>คำสั้งซื้อวันนี้</th>
                        <th>รอดำเนินการ</th>
                        <th>จัดการข้อมูล</th>
                    </thead>
                    <tbody>
                        <td><?php echo $data_count_order['total']; ?> รายการ</td>
                        <td><?php echo $data_count_today['today']; ?> รายการ</td>
                        <td><?php echo $data_count_inprogress['inprogress']; ?> รายการ</td>
                        <td><button class="btn btn_navy"><a href="manage_order.php" style="text-decoration: none; color:white;">จ้ดการข้อมูล</a></button></td>
                    </tbody>
                </table>
            </div>
            <div class="col-10" style="margin:auto auto 2rem;">
                <h5 style="font-weight:500; text-align:left; color:slategrey;"><i class="bi bi-list-ol"></i>&nbsp; ข้อมูลสินค้า&nbsp;(เหลือน้อย)</h5>
                <table class="table table-light table-striped bdr" style="width: 100%;">
                    <thead>
                        <th></th>
                        <th>ชื่อสินค้า</th>
                        <th>คงเหลือ</th>
                        <th>เพิ่มสินค้า</th>
                    </thead>
                    <tbody>
                        <?php while ($data_product = $sql_product->fetch_assoc()) {
                        ?>
                            <tr>
                                <td style="text-align: center; padding-left:1rem;"><span class="badge" style="background-color:#021b39 ;"><?php echo $data_product['product_id']; ?></span></td>
                                <td style="text-align: left;"><?php echo $data_product['product_name']; ?></td>
                                <td style="text-align: center; color:darkred; font-weight:bold"><?php echo number_format($data_product['product_remain']); ?></td>
                                <td style="padding-right: 1rem ;"><button type="button" class="btn btn_navy"><a href="edit_product.php?product_id=<?php echo $data_product['product_id']; ?>" style="text-decoration:none; color:white;" target="_blank">จัดการข้อมูล</button></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include 'partition/footer.php'; ?>
</body>

</html>