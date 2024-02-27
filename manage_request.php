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
    </style>

    <title>Benz Online</title>
</head>

<body>
    <?php include 'partition/header.php';
    include 'partition/menu_index.php';
    include 'partition/menu_manage.php'; ?>

    <div class="container-fluid container-lg" style="background-color:white; margin-top:8px; padding: 3rem; min-height:60vh;">
        <h3 style="font-weight:bold; margin-left:1rem; margin-bottom:2rem; color:#021b39; text-align:center;">คำขอสิทธิดูแลระบบ</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="text-align:center ;">รหัสสมาชิก</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th style="text-align:right">วันที่ร้องขอ</th>
                    <th style="text-align:center ;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connect.php';
                // if (isset($_GET['member_id'])) {
                //     $delete_id = $_GET['member_id'];
                //     $sql_delete = $conn->query("delete from member where member_id=$delete_id");
                //     if ($sql_delete == true) {
                //         echo "<script>alertInto('ลบข้อมูลเรียบร้อย','manage_member.php')</script>";
                //     }
                // }
                if (isset($_GET['member_id']) && isset($_GET['action'])) {
                    $action_member = $_GET['member_id'];
                    $action_resual = $_GET['action'];
                    $sql_request = $conn->query("update member set member_level = $action_resual where member_id = $action_member");
                    if ($sql_request) {
                        echo "<script>popup('success','ดำเนินการเรียบร้อย','manage_request.php')</script>";
                    }
                }
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $perpage = 5;
                $count = ($page - 1) * $perpage;
                $sql = $conn->query("select * from member where member_level=1 limit $count, $perpage");
                while ($data = $sql->fetch_assoc()) {
                ?>
                    <tr>
                        <td style="text-align:center ;"><?php echo $data['member_id']; ?></td>
                        <td><a href="member.php?id=<?php echo $data['member_id'];  ?>" target="_blank" style="text-decoration:none; color:black;"><?php echo $data['member_firstname']; ?></a></td>
                        <td><?php echo $data['member_lastname']; ?></td>

                        <td style="text-align:right;"><?php echo $data['member_date']; ?></td>
                        <td align="center">
                            <div class="btn btn-group" style="padding:0%;">
                                <button class="btn btn-success"><a href="manage_request.php?member_id=<?php echo $data['member_id']; ?>&&action=2" style="text-decoration:none; color:white;"><i class="bi bi-check-square-fill"></i></i>&nbsp;approve</a></button>
                                <button class="btn btn-danger"><a href="manage_request.php?member_id=<?php echo $data['member_id']; ?>&&action=0" style="text-decoration:none; color:white;"><i class="bi bi-x-square-fill"></i>&nbsp;reject</a></button>
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
    <?php include 'partition/footer.php'; ?>
</body>

</html>