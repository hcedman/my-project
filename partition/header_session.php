<?php
require_once('connect.php');
$user_id = $_SESSION['user'];
$sql_header = $conn->query("select * from member where member_id = '$user_id'");
$data_header = mysqli_fetch_assoc($sql_header);
?>
<form action="search.php" method="get">
<div class="container-fluid-lg" id="header">
    <div class="row">
        <!-- <div class="d-none d-sm-block col-md-1 col-xl-1 "></div> -->
        <div class="col-xs-12 col-sm-3 col-md-2 col-xl-3 "><img src="img/logo.png" id="logo"></div>
        <div class="col-xs-12 col-sm-6 col-md-5 col-xl-10 " id="search">
            <div class="input-group">
            <input type="text" class="form-control" id="search" name="search" placeholder="ค้นหาสินค้า" value="">
                <button class="btn btn-outline-light " id="btn_search" type="submit">ค้นหา</button>
            </div>
        </div>
        <div class="col-sm-3 col-md-3 col-xl-2" id="btnLogin">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" style="text-decoration:none; color:white; display:inline-table"><?php echo $data_header['member_firstname']; ?> &nbsp;</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">จัดการข้อมูลส่วนตัว</a></li>
                    <li><a class="dropdown-item" href="logout.php">ออกจากระบบ</a></li>
                </ul>
            </li>

        </div>
        <div class="d-none d-sm-block col-md-1 col-xl-1 "></div>
    </div>
</div>

</form>