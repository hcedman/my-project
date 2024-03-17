<script>
    function develop() {
        alert("อยู่หว่างพัฒนา");
    }
</script>
<style>
    #link1,
    #link2,
    #link3,
    #link4,
    #btn_promotion {
        color: white;
        text-decoration: none;
        font-weight: 500;
    }

    .dropdown-menu>li>a {
        font-weight: 400;
        font-size: medium;
        color: #021b39;

    }

    .navbar-light>button {
        background-color: #021b39;
    }

</style>
<?php
include 'connect.php';
$sql_comm = $conn->query("select rec_id from recommend where rec_state = 1");
$count = $sql_comm->num_rows;
$_SESSION['count_rec'] = $count;
?>

<div class="container-fluid container-lg" style="background-color:white; margin-top: 8px; ">
    <nav class="navbar-light" style=" display:flex; justify-content:flex-start; flex-wrap:wrap; padding-bottom:0.5rem;">
        <button class="btn btn-primary" style="margin:0.5rem 0.5rem auto 0.5rem;"><a href="manage.php" id="link3"><i class="bi bi-house-door-fill"></i>&nbsp; ข้อมูลร้านค้า</a></button>
        <div class="btn-group" role="group" style="margin:0.5rem 0.5rem auto 0.5rem;">
            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#021b39; color:white"><a href="manage_product.php" id="link1"><i class="bi bi-list-ol"></i>&nbsp; สินค้า</a></button>
            <ul class=" dropdown-menu">
                <li><a class=" dropdown-item" href="manage_product.php">จัดการข้อมูลสินค้า</a></li>
                <li><a class=" dropdown-item" href="add_product.php">เพิ่มรายการสินค้า</a></li>
            </ul>
        </div>
        <div class="btn-group" role="group" style="margin:0.5rem 0.5rem auto 0.5rem;">
            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#021b39; color:white"><a href="manage_product.php" id="link2"><i class="bi bi-person-lines-fill"></i>&nbsp; สมาชิก</a></button>
            <ul class=" dropdown-menu">
                <li><a class=" dropdown-item" href="manage_member.php">จัดการข้อมูลลูกค้า</a></li>
                <li><a class=" dropdown-item" href="manage_request.php">คำขอเพิ่มสิทธ์</a></li>
            </ul>
        </div>
        <button class="btn btn-primary" style="margin:0.5rem 0.5rem auto 0.5rem;"><a href="manage_order.php" id="link3"><i class="bi bi-card-list"></i>&nbsp; จัดการออเดอร์</a></button>
        <button class="btn btn-primary" style="margin:0.5rem 0.5rem auto 0.5rem;"><a href="manage_rec.php" id="link3"><i class="bi bi-chat-square-quote"></i>&nbsp; คำแนะนำบริการ
                <span class="badge rounded-pill bg-danger"><?php if ($count >= 1) {
                                                                echo $count;
                                                            } ?></span></a>
        </button>
        <button onclick="develop()" class="btn btn-primary" style="margin:0.5rem 0.5rem auto 0.5rem;" name="btn_promotion" id="btn_promotion"><i class="bi bi-tags-fill"></i>&nbsp;จัดการโปรโมชัน</button>
        <button class="btn btn-primary" id="btn_setting" style="margin:0.5rem 0.5rem auto 0.5rem;"><a href="config.php" id="link3"><i class="bi bi-gear-fill"></i>&nbsp; ตั้งค่าเว็บไซต์</a></button>
    </nav>
</div>