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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <style>
        #link1,
        #link2,
        #link3,
        #link4,
        #linkp1 {
            color: white;
            text-decoration: none;
        }

        .page-item.active .page-link {
            background-color: #021b39;
            border: #021b39;
        }

        .pagination>li>a {
            color: #021b39;
        }

        td {
            vertical-align: middle;
        }

        th {
            color: gray;
            font-size: medium;
        }
    </style>

    <title>Benz Online</title>
</head>

<body>
    <?php include 'partition/header.php';
    include 'partition/menu_index.php';
    include 'partition/menu_manage.php'; ?>

    <div class="container-fluid container-lg" style="background-color:white; margin-top:8px; padding: 3rem; min-height: 70vh ;">
        <h3 style="font-weight:bold; margin-left:1rem; margin-bottom:2rem; color:#021b39; text-align:center;">จัดการข้อมูลลูกค้า</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th style="text-align:left;">E-mail</th>
                    <th style="text-align:center">สถานะ</th>
                    <th style="text-align:center ;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connect.php';

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $perpage = 10;
                $count = ($page - 1) * $perpage;
                $user_id = $_SESSION['user_id'];
                $sql = $conn->query("select * from member limit $count, $perpage");
                if (isset($_GET['member_id'])) {
                    $delete_id = $_GET['member_id'];
                    $sql_delete = $conn->query("delete from member where member_id=$delete_id");
                    if ($sql_delete == true) {
                        if ($user_id == $delete_id) {
                            echo "<script>alertUpdate('success','ดำเนินการข้อมูลสมาชิกเรียบร้อย','" . "logout.php" . "')</script>";
                        } else {
                            $link_finished = "manage_member.php?page=" . $page;
                            echo "<script>alertUpdate('success','ดำเนินการข้อมูลสมาชิกเรียบร้อย','" . $link_finished . "')</script>";
                        }
                    }
                }
                while ($data = $sql->fetch_assoc()) {
                    if ($data['member_level'] == 0) {
                        $level = "member";
                    } elseif ($data['member_level'] == 1) {
                        $level = "requesting admin";
                    } else {
                        $level = "admin";
                    }
                ?>
                    <tr>
                        <td style="text-align:center;"><span class="badge" style="background-color: #021b39; font-size:small;"><?php echo $data['member_id']; ?></span></td>
                        <td style="text-align:left;"><a href="member.php?id=<?php echo $data['member_id'];  ?>" target="_blank" style="text-decoration:none; color:black;"><?php echo $data['member_firstname']; ?></a></td>
                        <td style="text-align:left;"><?php echo $data['member_lastname']; ?></td>
                        <td style="text-align:left;"><?php echo $data['member_email']; ?></td>
                        <td style="text-align:center;"><span class="badge bg-primary" id="badge_status" style="font-size:small; font-weight:500;"><?php echo $level; ?></span></td>
                        <td align="center">
                            <div class="btn btn-group" style="padding:0%;">
                                <button class="btn btn-primary"><a href="purchase_member.php?member_id=<?php echo $data['member_id']; ?>" target="_blank" style="text-decoration:none; color:white;"><span><i class="bi bi-pencil-square"></i>&nbsp;รายการสั่งซื้อ</a></span></button>
                                <?php $link = "manage_member.php?member_id=" . $data['member_id'] . "&page=" . $page; ?>
                                <button class="btn btn-danger" onclick="alertConfirm('ลบ','ยืนยันการลบบัญชีข้อมูลหรือไม่','<?php echo $link ?>')"><i class="bi bi-trash"></i></a></button>
                            </div>
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
                $sql_total = $conn->query("select * from member");
                $data_count = $sql_total->num_rows;
                $row = ceil($data_count / $perpage);
                for ($i = 1; $i <= $row; $i++) {
                    if ($page == $i) {
                ?>
                        <li class="page-item active" aria-current="page"><span class="page-link"><?php echo $i; ?></span></li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item"><a class="page-link" href="manage_member.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                    }
                    ?>
                <?php }
                if ($page < $row) {
                ?>
                    <li class="page-item">
                        <a class="page-link" href="manage_member.php?page=<?php echo $next = $page + 1; ?>">Next</a>
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
    <script language="javascript">
        const badge = document.querySelectorAll('#badge_status');
        badge.forEach(newBadge => {
            let value = newBadge.textContent;
            if (value == 'admin') {
                newBadge.className = "badge bg-danger";
            } else if (value == 'member') {
                newBadge.className = "badge bg-secondary";
            } else {
                newBadge.className = "badge bg-warning";
            }
        })
    </script>
    <?php include 'partition/footer.php'; ?>
</body>

</html>