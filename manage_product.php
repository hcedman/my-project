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
    <style>
        #link1,
        #link2,
        #link3,
        #link4,
        #link1 {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .page-item.active .page-link {
            background-color: #021b39;
            border: #021b39;

        }
        .pagination>li>a {
            color: #021b39;
            font-weight:500;
        }
        th{
            color:gray;
            font-size:medium;
            font-weight:500;
  
        }
        #product_tap1, #product_tap2, #product_tap3, #product_tap4{
            color: #566573;
            font-weight:500;
        }
        #nav_tab{
            display: flex;
            justify-content: center;
        }
    </style>

    <title>Benz Online</title>
</head>

<body>
    <?php include 'partition/header.php' ?>
    <?php include 'partition/menu_index.php' ?>
    <?php include 'partition/menu_manage.php' ?>

    <div class="container-fluid container-lg" style="background-color:white; margin-top:8px; padding: 3rem; ">
        <h3 style="font-weight:bold; margin-left:1rem; margin-bottom:2rem; color:#021b39; text-align:center;">จัดการข้อมูลสินค้า</h3>
        <div style="margin: 3rem auto 2rem ">
            <ul class="nav nav-tabs" id="nav_tab">
                <li class="nav-item">
                    <a class="nav-link active" id="product_tap1" aria-current="page" href="manage_product.php">สินค้าทั้งหมด</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product_tap2" href="manage_product.php?status=1">สินค้าปกติ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product_tap3" href="manage_product.php?status=2">สินค้าใกล้หมด</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product_tap4" href="manage_product.php?status=0&s=0">สินค้ายกเลิกการขายแล้ว</a>
                </li>
            </ul>
        </div>
        <div class="table-responsive-md" style="min-height: 65vh;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col-md-3" style="text-align:center ;"></th>
                        <th>ชื่อสินค้า</th>
                        <th>ประเภท</th>
                        <th>สถานะ</th>
                        <th style="text-align:center ;">จำนวน</th>
                        <th style="text-align:center">ราคา</th>
                        <th style="text-align:center ;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connect.php';
                    if (isset($_GET['update_id']) && isset($_GET['val'])) {
                        $update_id = $_GET['update_id'];
                        $value = $_GET['val'];
                        $sql_update_stmt = $conn->query("update product set product_status = $value where product_id = $update_id");
                        if ($sql_update_stmt == true) {
                            echo "<script>alertUpdate('success','ดำเนินการเรียบร้อย','manage_product.php?page=" . $_GET['page'] . "')</script>";
                        }
                    }
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $perpage = 6;
                    $count = ($page - 1) * $perpage;

                    if (isset($_GET['status'])) {
                        $input_status = $_GET['status'];
                        if ($input_status == 1) {
                            $sql_status = "select * from product where product_status = '1' limit $count, $perpage   ";
                        } else if ($input_status == 2) {
                            $sql_status = "select * from product where product_status = '1' order by product_remain ASC limit $count, $perpage ";
                        } else {
                            $sql_status = "select * from product where product_status = '0'  limit $count, $perpage   ";
                        }
                    } else {
                        $sql_status = "select * from product  limit $count, $perpage  ";
                    }
                    $sql = $conn->query($sql_status);
                    while ($data = $sql->fetch_assoc()) {
                        $product_picture = $data['product_id'];
                        $sql_picture = $conn->query("select picture_name from picture where product_id = $product_picture limit 1");
                        $data_picture = $sql_picture->fetch_assoc();
                        if ($data['product_status'] == 1) {
                            $status = "ปกติ";
                        } else {
                            $status = "ปิดขาย";
                        }
                    ?>
                        <tr>
                            <td style="text-align:center ;"><span class="badge" style="background-color: #021b39; font-size:small; font-weight:bold; margin-top:0.6rem; "><?php echo $data['product_id']; ?></span></td>
                            <td><img src="upload/<?php echo $data_picture['picture_name']; ?>" style="width:5rem; height:5rem;" class="rounded mx-auto d-block"></td>
                            <td><a href="product.php?id=<?php echo $data['product_id'];  ?>" target="_blank" style="text-decoration:none; color:#2D3034; font-size:small; font-weight: 400;"><?php echo $data['product_name']; ?></a></td>
                            <td style=""><?php echo $data['product_type']; ?></td>
                            <td><span class="badge bg-success" id="badge_status"><?php echo $status ?></span></td>
                            <td style="text-align:center;"><?php echo number_format($data['product_remain']) ?></td>
                            <td style="text-align:right; font-weight:500; color:darkred"><?php echo number_format($data['product_price'], 2); ?></td>
                            <td width="180px">
                                <div class="btn btn-group" style="padding:0%;">
                                    <button class="btn btn-warning"><a href="edit_product.php?product_id=<?php echo $data['product_id']; ?>" style="text-decoration:none; color:white;"><i class="bi bi-pencil-square"></i></a></button>
                                    <button class="btn btn-success" style="font-weight: 500;" id="btn_open" onclick="alertConfirm('เปิด','ต้องการเปิดการขายสินค้านี้หรือไม่','manage_product.php?page=<?php echo $page; ?>&update_id=<?php echo $data['product_id']; ?>&val=1')">เปิดขาย</button>
                                    <button class="btn btn-danger" style="font-weight:500;" id="btn_close" onclick="alertConfirm('ปิด','เมื่อปิดการขายสินค้านี้จะไม่ปรากฏในรายการค้นหาสินค้า','manage_product.php?page=<?php echo $page; ?>&update_id=<?php echo $data['product_id']; ?>&val=0')">ปิดขาย</button>

                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <?php
        if ((isset($_GET['s']))) {
            $change_button = 0;
        } else {
            $change_button = 1;
        }
        ?>
        <span hidden id="status_hide"><?php echo $input_status; ?></span>
        <span hidden id="button_update_hide"><?php echo $change_button; ?></span>

        <nav aria-label="">
            <ul class="pagination">
                <?php
                $previous = $page - 1;
                if ($previous > 0) {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="manage_product.php?page=<?php echo $previous; ?>">Previous</a>
                    </li>
                <?php
                } else {
                    $previous = 1;
                ?>
                    <li class="page-item disabled" aria-disabled="true">
                        <a class="page-link" href="manage_product.php?page=<?php $previous; ?>">Previous</a>
                    </li>
                <?php
                }
                ?>
                <?php
                $sql_total = $conn->query("select * from product");
                $data_count = $sql_total->num_rows;
                $row = ceil($data_count / $perpage);
                for ($i = 1; $i <= $row; $i++) {
                    if ($page == $i) {
                ?>
                        <li class="page-item active" aria-current="page"><span class="page-link"><?php echo $i; ?></span></li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item"><a class="page-link" href="manage_product.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                    }
                    ?>
                <?php }
                if ($page < $row) {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="manage_product.php?page=<?php echo $next = $page + 1; ?>">Next</a>
                    </li>
                <?php
                } else {
                    $next = $row;
                ?>
                    <li class="page-item disabled" aria-disabled="true">
                        <a class="page-link" href="">Next</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </div>

    <script>
        const status = document.querySelector('#status_hide').textContent;
        const tabStatus = document.querySelectorAll('.nav-link');
        const data = tabStatus[0].textContent;
        const changeButton = document.querySelector('#button_update_hide').textContent;
        const btnClose = document.querySelectorAll('#btn_close');
        const btnOpen = document.querySelectorAll('#btn_open');
        const badgeStatus = document.querySelectorAll('#badge_status');
        badgeStatus.forEach(badgeRed => {
            badge = badgeRed.textContent;
            if (badge == "ปิดขาย") {
                badgeRed.className = "badge bg-danger";
            }
        })
        if (changeButton == 0) {
            btnClose.forEach(button => {
                button.hidden = true;
            })
        } else if (changeButton == 1) {
            btnOpen.forEach(button => {
                button.hidden = true;
            })
        }
        if (status == 1) {
            tabStatus[5].className = "nav-link";
            tabStatus[5].classList.add("nav_product_style");
            tabStatus[6].className = "nav-link active";
            tabStatus[6].classList.add("nav_product_active");
            tabStatus[7].className = "nav-link";
            tabStatus[7].classList.add("nav_product_style");
            tabStatus[8].className = "nav-link";
            tabStatus[8].classList.add("nav_product_style");
        } else if (status == 2) {
            tabStatus[5].className = "nav-link";
            tabStatus[5].classList.add("nav_product_style");
            tabStatus[6].className = "nav-link";
            tabStatus[6].classList.add("nav_product_style");
            tabStatus[7].className = "nav-link active";
            tabStatus[7].classList.add("nav_product_active");
            tabStatus[8].className = "nav-link";
            tabStatus[8].classList.add("nav_product_style");
        } else if (status == 0) {
            tabStatus[5].className = "nav-link";
            tabStatus[5].classList.add("nav_product_style");
            tabStatus[6].className = "nav-link";
            tabStatus[6].classList.add("nav_product_style");
            tabStatus[7].className = "nav-link";
            tabStatus[7].classList.add("nav_product_style");
            tabStatus[8].className = "nav-link active";
            tabStatus[8].classList.add("nav_product_active");
        } else {
            tabStatus[5].className = "nav-link active";
            tabStatus[5].classList.add("nav_product_active");
            tabStatus[6].className = "nav-link";
            tabStatus[6].classList.add("nav_product_style");
            tabStatus[7].className = "nav-link";
            tabStatus[7].classList.add("nav_product_style");
            tabStatus[8].className = "nav-link";
            tabStatus[8].classList.add("nav_product_style");
        }
    </script>
    <script src="script.js"></script>
    <?php include 'partition/footer.php'; ?>

</body>

</html>