<?php
session_start();
include 'connect.php';
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
    <script src="node_modules/bootstrap-input-spinner/src/bootstrap-input-spinner.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script>
    </script>
    <style>
        body {
            margin: 0;
        }

        #container_cart {
            background-color: white;
            min-height: 75vh;
            margin-top: 8px;
            padding-bottom: 1rem;
        }

        h3 {
            font-weight: bold;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        #cart_list {
            margin: 1rem;
            padding: 5px;
            border: 1px solid;
            border-color: lightgrey;
            border-radius: 10px;
        }

        #cart_img {
            width: 100px;
            height: 100px;
        }

        #col3 {
            display: grid;
            align-items: center;
            justify-content: center;
            font-weight:500;
            color:darkred;
        }

        #col4,
        #col5,
        #col6 {
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight:500;
            color:darkred;
        }

        #col7,
        #col8,
        #col9,
        #col10,
        #col11 {
            margin: 1rem;
            text-align: end;
            justify-content: end;
            justify-items: end;
        }

        #cart_box {
            margin: 1rem;
            display: flex;
            align-items: center;
            justify-content: end;
        }
    </style>
    <title>Benz Online</title>
</head>

<body>
    <?php
    include 'partition/header.php';
    include 'partition/menu_index.php';
    require 'connect.php';
    $member_id = $_SESSION['user_id'];
    $sql_cart = $conn->query("select * from cart where member_id = $member_id");
    $count_order = $sql_cart->num_rows;

    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $member_id = $_GET['member_id'];
        $sql_delete = $conn->query("delete from cart where cart_id = $delete_id");
        if ($sql_delete) {
            echo "<script>alertUpdate('success','ลบรายการสินค้าเรียบร้อย','cart.php?id=" . $member_id . "')</script>";
        } else {
            echo "<script>alertInto('error','เกิดข้อผิดพลาด','cart.php?id=" . $member_id . "')</script>";
        }
    }
    ?>
    <form action="checkout.php" method="POST" enctype="multipart/form-data">
        <div class="container-fluid container-lg" id="container_cart">
            <div style="min-height: 55vh ; padding-top:2rem; padding-bottom: 2rem;">
                <h3 style="margin-left:2rem ; text-align:center;">รายการสินค้าในรถเข็น</h3>
                <div class="row" id="cart_box">
                    <div class="col-2" style="font-weight:bold ;">สินค้า</div>
                    <div class="col"></div>
                    <div class="col-2" style="text-align:center; font-weight: bold; align-items: center;">ราคาต่อชิ้น</div>
                    <div class="col-2" style="text-align:center; font-weight: bold; align-items: center;">จำนวน</div>
                    <div class="col-1" style="text-align:center; font-weight: bold; align-items: center;">ราคารวม</div>
                    <div class="col-1" style="text-align:center; font-weight: bold; align-items: center;">ลบ</div>
                </div>
                <?php
                $total_price = 0;
                $total_delivery = 0;
                if ($count_order > 0) {
                    while ($data_cart = $sql_cart->fetch_assoc()) {
                        $product_id = $data_cart['product_id'];
                        $sql_list_cart = $conn->query("select * from product where product_id = $product_id");
                        $data_list_cart = $sql_list_cart->fetch_assoc();
                        $total = $data_list_cart['product_price'] * $data_cart['quantity'];
                        $delivery = $data_list_cart['product_delivery'];
                        $total_price += $total;
                        $total_delivery += $delivery;
                        $last_total = $total_price + $total_delivery;
                        $sql_picture = $conn->query("select * from picture where product_id = $product_id");
                        $data_picture = $sql_picture->fetch_assoc();
                ?>
                        <div class="row" id="cart_list">
                            <input type="hidden" name="cart_id[]" value="<?php echo $data_cart['cart_id']; ?>">
                            <div class="col-2"><img id="cart_img" src="upload/<?php echo $data_picture['picture_name']; ?>" alt=""></div>
                            <div class="col" style="font-weight:500 ;"><?php echo $data_list_cart['product_name']; ?></div>
                            <div class="col-2" id="col3"><?php echo "&#3647;" . number_format($data_list_cart['product_price']); ?>
                                <span id="delivery" style="font-size: small; color: dimgrey;">ค่าจัดส่ง&nbsp;<?php echo $data_list_cart['product_delivery']; ?></span>
                            </div>
                            <div class="col-2" id="col4"><input type="number" id="qty_box" name="qty[]" value="<?php echo $data_cart['quantity']; ?>" min="1" max="<?php echo $data_list_cart['product_remain']; ?>" step="1" /></div>
                            <div class="col-1" id="col5"><?php echo "&#3647;" . number_format($total); ?><input type="hidden" name="product_id[]" value="<?php echo $data_list_cart['product_id']; ?>"></div>
                            <div class="col-1" id="col6"><button class="btn btn-secondary" type="button" name="btn_delete">
                                    <a href="cart.php?delete_id=<?php echo $data_cart['cart_id']; ?>&member_id=<?php echo $member_id; ?>"><i class="bi bi-trash3" style="color:white"></i></a></button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
            </div>
            <div>
                <div class="row" style="border-collapse: collapse; vertical-align:bottom;">
                    <div class="col-6" style="text-align:start; padding-left:3rem; padding-right:2rem; font-weight: bold;"><span>จำนวน&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $count_order; ?>&nbsp;&nbsp;รายการ</span></div>
                    <div class="col-6" style="text-align:end; padding-left:3rem; padding-right:2rem; font-weight: bold; ">รวมค่าสินค้า&nbsp;&nbsp;&nbsp;&nbsp;&#3647;<?php echo number_format($total_price); ?></div>
                </div>
                <div class="col" id="col9">รวมค่าจัดส่ง&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "&#3647;" . number_format($total_delivery); ?></div>
                <div class="col" id="col10">ยอดคำสั่งซื้อทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-weight:bolder; font-size:larger; color:red"><?php echo "&#3647;" . number_format($last_total); ?></span></div>
                <div class="col" id="col11"><button class="btn btn-danger" type="submit" name="btn_buy" style="width: 10rem; margin-bottom: 2rem;">สั่งซื้อสินค้า</button></div>

            </div>
        <?php
                } else {
        ?>
            <div class="alert alert-primary" role="alert" style="width:80%; display: block; margin:4rem auto auto auto; text-align:center;">
                ไม่มีสินค้าในรถเข็น
            </div>
        <?php
                }
        ?>
        </div>
    </form>
    <?php include 'partition/footer.php';  ?>
</body>

</html>