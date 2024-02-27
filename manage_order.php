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
        #link4,
        #linkp1 {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .btn,
        th{
            color:gray;
            font-size:medium;
            font-weight:bold;
  
        }
        td {
            font-weight: bold;
            white-space: nowrap;
            overflow: auto;
            vertical-align: middle;
        }

        .page-item.active .page-link {
            background-color: #021b39;
            border: #021b39;
            font-weight: bold;
        }

        .pagination>li>a {
            color: #021b39;
            font-weight: bold;
        }

    </style>
    <title>Benz Online</title>
</head>

<body>
    <?php include 'partition/header.php';
    include 'partition/menu_index.php';
    include 'partition/menu_manage.php'; ?>

    <div class="container-fluid container-lg" style="background-color:white; margin-top:8px; padding: 3rem; min-height: 70vh ;">
        <h3 style="font-weight:bold; margin-left:1rem; margin-bottom:2rem; color:#021b39; text-align:center;">จัดการข้อมูลคำสั่งซื้อ</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="text-align:center ;">
                        <div></div>
                    </th>
                    <th style="text-align:center ;">รหัสลูกค้า</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th style="text-align:center ;">วันที่</th>
                    <th style="text-align:right ;">ราคารวม</th>
                    <th style="text-align:center ;">รายละเอียด</th>
                    <th style="text-align:center ;">อัพเดทสถานะคำสั่งซื้อ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connect.php';
                if (isset($_GET['order_id'])) {
                    $order_id = $_GET['order_id'];
                    $order_status = $_GET['order_status'];
                    $sql_update_order = $conn->query("update orders set order_status = '$order_status' where order_id = $order_id");
                    if ($sql_update_order == true) {
                        echo "<script>alertUpdate('success','อัพเดทข้อมูลเรียบร้อย','manage_order.php')</script>";
                    }
                }
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $perpage = 10;
                $count = ($page - 1) * $perpage;

                $sql_order = $conn->query("select * from orders limit $count, $perpage");
                while ($data_order = $sql_order->fetch_assoc()) {
                ?>
                    <tr>
                        <td style="text-align:center;"><span class="badge" style="font-size:small; background-color:#021b39;"><?php echo $data_order['order_id']; ?></span></td>
                        <td style="text-align:center ;"><?php echo $data_order['member_id']; ?></td>
                        <td><?php echo $data_order['order_firstname'] . "&nbsp" . $data_order['order_lastname']; ?></td>
                        <td style="text-align:center;"><?php echo $data_order['order_date']; ?></td>
                        <td style="text-align:right ; color:darkred;"><?php echo number_format($data_order['order_total']); ?></td>
                        <td style="text-align:center;"><button class="btn btn-warning" id="xxx"><a href="order_detail.php?order_id=<?php echo $data_order['order_id']; ?>" style="text-decoration:none; color:white;" target="_blank"><i class="bi bi-pencil-square"></i>&nbsp;รายละเอียด</a></button></td>
                        <td>
                            <?php
                            $status = $data_order['order_status'];
                            if ($status == "inprogress") {
                            ?>
                                <div class="btn btn-group" style="padding:0%;">
                                    <button class="btn btn-primary" disabled><i class="bi bi-check-square-fill"></i>&nbsp;<span class="underline">INPROGRESS</span></button>
                                    <button class="btn btn-secondary"><a href="manage_order.php?page=<?php echo $page; ?>&order_id=<?php echo $data_order['order_id']; ?>&order_status=finish" style="text-decoration:none; color:white;"><i class="bi bi-pencil-square"></i>&nbsp;FINISHED</a></button>
                                    <button class="btn btn-secondary"><a href="manage_order.php?page=<?php echo $page; ?>&order_id=<?php echo $data_order['order_id']; ?>&order_status=cancel" style="text-decoration:none; color:white;"><i class="bi bi-pencil-square"></i>&nbsp;CANCEL</a></button>
                                </div>
                            <?php
                            } elseif ($status == "finish") {
                            ?>
                                <div class="btn btn-group" style="padding:0%;">
                                    <button class="btn btn-secondary" disabled><i class="bi bi-pencil-square"></i>&nbsp;<span class="line-through">INPROGRESS</span></button>
                                    <button class="btn btn-primary" disabled><i class="bi bi-check-square-fill"></i>&nbsp;<span class="underline">FINISHED</span></button>
                                    <button class="btn btn-secondary"><a href="manage_order.php?page=<?php echo $page; ?>&order_id=<?php echo $data_order['order_id']; ?>&order_status=cancel" style="text-decoration:none; color:white;"><i class="bi bi-pencil-square"></i>&nbsp;CANCEL</a></button>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="btn btn-group" style="padding:0%;">
                                    <button class="btn btn-secondary" disabled><i class="bi bi-pencil-square"></i>&nbsp;<span class="line-through">INPROGRESS</span></button>
                                    <button class="btn btn-secondary" disabled><i class="bi bi-pencil-square"></i>&nbsp;<span class="line-through">FINISHED</span></button>
                                    <button class="btn btn-danger" disabled><i class="bi bi-check-square-fill"></i>&nbsp;<span class="underline">CANCEL</span></button>
                                </div>
                            <?php
                            }
                            ?>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
    <div class="container-fluid container-lg bg-white" style="padding:1rem 0rem 3rem 4rem ;">
        <nav aria-label="">
            <ul class="pagination">
                <?php
                $previous = $page - 1;
                if ($previous > 0) {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="manage_member.php?page=<?php echo $previous; ?>">Previous</a>
                    </li>
                <?php
                } else {
                    $previous = 1;
                ?>
                    <li class="page-item disabled" aria-disabled="true">
                        <a class="page-link" href="manage_member.php?page=<?php $previous; ?>">Previous</a>
                    </li>
                <?php
                }
                ?>
                <?php
                $sql_total = $conn->query("select * from orders");
                $data_count = $sql_total->num_rows;
                $row = ceil($data_count / $perpage);
                for ($i = 1; $i <= $row; $i++) {
                    if ($page == $i) {
                ?>
                        <li class="page-item active" aria-current="page"><span class="page-link"><?php echo $i; ?></span></li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item"><a class="page-link" href="manage_order.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                    }
                    ?>
                <?php }
                if ($page < $row) {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="manage_order.php?page=<?php echo $next = $page + 1; ?>">Next</a>
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
    <?php include 'partition/footer.php'; ?>
</body>

</html>