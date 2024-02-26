<script>
    function develop(){
        alert("อยู่หว่างพัฒนา");
    }
</script>
<style>
    #link1,
    #link2,
    #link3,
    #link4 {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }

    .dropdown-menu>li>a {
        font-weight: bold;
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
    <nav class="navbar-light" style="padding: 8px;">
        <div class="btn-group" role="group" style="margin-right: 5px; ">
            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#021b39; color:white"><a href="manage_product.php" id="link1"><i class="bi bi-list-ol"></i>&nbsp; สินค้า</a></button>
            <ul class=" dropdown-menu">
                <li><a class=" dropdown-item" href="manage_product.php">จัดการข้อมูลสินค้า</a></li>
                <li><a class=" dropdown-item" href="add_product.php">เพิ่มรายการสินค้า</a></li>
            </ul>
        </div>
        <div class="btn-group" role="group" style="margin-right: 5px; ">
            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:#021b39; color:white"><a href="manage_product.php" id="link2"><i class="bi bi-person-lines-fill"></i>&nbsp; สมาชิก</a></button>
            <ul class=" dropdown-menu">
                <li><a class=" dropdown-item" href="manage_member.php">จัดการข้อมูลลูกค้า</a></li>
                <li><a class=" dropdown-item" href="manage_request.php">คำขอเพิ่มสิทธ์</a></li>
            </ul>
        </div>


        <button class="btn btn-primary" style="margin-right: 5px; "><a href="manage_order.php" id="link3"><i class="bi bi-card-list"></i>&nbsp; จัดการออเดอร์</a></button>
        <button class="btn btn-primary" style="margin-right: 5px; "><a href="manage_rec.php" id="link3"><i class="bi bi-chat-square-quote"></i></i>&nbsp; คำแนะนำบริการ 
        <span class="badge rounded-pill bg-danger"><?php if($count >=1){ echo $count;} ?></span>
    
    </a></button>
        <button onclick="develop()" class="btn btn-primary" style="margin-right: 5px; " name="btn_promotion" id="btn_promotion" >จัดการโปรโมชัน</button>
    </nav>
</div>

