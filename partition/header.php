<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="script.js"></script>
<script>
    $(document).ready(function() {
        $("input[type='number']").inputSpinner()
        $('#btn_cart').click(function() {
            var id = $('#btn_cart').attr('data-id');
            var quantity = $('#quantity').val();
            var data = {
                'product_id': id,
                'quantity': quantity
            };
            $.ajax({
                url: 'add_cart.php',
                type: 'get',
                data: data,
                success: function(result) {
                    alert(result);
                }
            });
        });
    });
</script>


<style>
    #header {
        background-color: #021b39;
    }

    #logo {
        margin-top: 5px;
        margin-bottom: 5px;
        margin-left: auto;
        margin-right: auto;
        display: block;
    }

    #box_search {
        margin-top: auto;
        margin-bottom: auto;
    }

    #box_login {
        margin-top: auto;
        margin-bottom: auto;
        margin-left: auto;
        margin-right: auto;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .dropdown-menu li {
        position: relative;
    }

    .dropdown-menu .submenu {
        display: none;
        position: absolute;
        left: 100%;
        top: -7px;
    }

    .dropdown-menu .submenu-left {
        right: 100%;
        left: auto;
    }

    .dropdown-menu>li:hover {
        background-color: #f1f1f1
    }

    .dropdown-menu>li:hover>.submenu {
        display: block;
    }
</style>
<?php


?>
<form action="search.php" method="GET">
    <div class="container-fluid" id="header">
        <div class="container-lg">
            <div class="row">
                <!-- <div class="d-none d-sm-block col-md-1 col-xl-1 col-xxl-1"></div> -->
                <div class="col-xs-12 col-sm-3 col-md-2 col-xl-2 col-xxl-2 "><img src="img/logo.png" id="logo"></div>
                <div class="col-xs-12 col-sm-6 col-md-5 col-xl-7 col-xxl-8" id="box_search">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="ค้นหาสินค้า" value="">
                        <button class="btn btn-outline-light " id="btn_search" type="submit">ค้นหา</button>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3 col-xl-3 col-xxl-2" id="box_login">
                    <?php
                    require 'connect.php';
                    if (isset($_SESSION['user_id'])) {
                        $member_id = $_SESSION['user_id'];
                        $member_level = $_SESSION['user_level'];
                        $sql_count = $conn->query("select * from cart where member_id = $member_id");
                        $data_count = $sql_count->num_rows;
                        $_SESSION['cart'] = $data_count;
                    ?>
                        <span>
                            <a href="cart.php?id=<?php echo $member_id ?>" style="text-decoration:none; color:white;">
                                <span class="badge rounded-pill bg-danger" style="font-size:x-small;" id="cart_count"><?php echo $_SESSION['cart']; ?></span>
                                <i class="bi bi-cart2"></i>
                                <i class="bi bi-three-dots-vertical"></i></a>
                            <?php
                            $sql_name = $conn->query("select member_firstname from member where member_id = $member_id");
                            $result_name = $sql_name->fetch_assoc();
                            ?>
                            <div class="dropdown" style="display:inline; padding:0%">
                                <button class="btn dropdown-toggle shadow-none" id="menu_top" data-bs-toggle="dropdown" aria-expanded="false" style="color:white ;">
                                    <i class="bi bi-person-fill"></i>&nbsp;<?php echo $result_name['member_firstname']; ?></button>
                                <ul class=" dropdown-menu" aria-labelledby="menu_top">
                                    <li><a href="account.php" class=" dropdown-item">บัญชีของฉัน</a></li>
                                    <li><a href="purchase.php" class=" dropdown-item">การซื้อของฉัน</a></li>
                                    <?php if ($member_level == 2) { ?><li><a href="manage.php" class=" dropdown-item">จัดการร้านค้า</a></li> <?php } ?>
                                    <li onclick="alertUpdate('success','ออกจากระบบเรียบร้อย','logout.php')" class=" dropdown-item">ออกจากระบบ</li>
                                </ul>
                            </div>
                            <!-- <a href="logout.php" style="text-decoration:none ; color:white;"><i class="bi bi-person-fill"></i>&nbsp; ออกจากระบบ</a> -->
                        </span>
                    <?php
                    } else {
                    ?>
                        <span>
                            <a href="login.php" style="text-decoration:none ; color:white;"></i>&nbsp; เข้าสู่ระบบ | ลงทะเบียน</a></span>
                    <?php
                    }
                    ?>
                </div>
                <div class="d-none d-sm-block col-md-1 col-xl-1 "></div>
            </div>
        </div>
    </div>
</form>