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
        #product_name,
        #product_type,
        #product_detail,
        #product_picture,
        label {
            width: 85%;
        }
    </style>

    <title>Benz Online</title>
</head>

<body>
    <?php include 'partition/header.php';
    include 'partition/menu_index.php';
    include 'partition/menu_manage.php';
    include 'function.php';
    include 'connect.php';
    if (isset($_POST["btn_submit"])) {
        $product_name = $_POST["product_name"];
        $product_type = $_POST["product_type"];
        $product_detail = $_POST["product_detail"];
        $product_price = $_POST["product_price"];
        $product_remain = $_POST["product_remain"];
        $product_delivery = $_POST["product_delivery"];
        $product_brand = $_POST["product_brand"];
        if (empty($product_name) || empty($product_type) || empty($product_detail) || empty($product_price) || empty($product_remain) || empty($product_delivery) || empty($product_brand)) {
            echo "<script>alertInto('warning','กรุณาใส่ข้อมูลให้ครบถ้วน','add_product.php')</script>";
        } else {
            $data = array($product_name, $product_type, $product_detail, $product_price, $product_remain, $product_delivery, $product_brand);
            $sql = "insert into product (product_name, product_type, product_detail, product_price, product_remain, product_delivery, product_brand)values(?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            if ($stmt) {
                $record = $stmt->insert_id;
                foreach ($_FILES['upload']['tmp_name'] as $key => $value) {
                    $file_tmp = $_FILES['upload']['tmp_name'][$key];
                    $file_name = $_FILES['upload']['name'][$key];
                    if ($full_name =  image_resize($file_tmp, $file_name)) {
                        $sql_upload = "insert into picture (product_id, picture_name)values(?,?)";
                        $stmt_upload = $conn->prepare($sql_upload);
                        $stmt_upload->bind_param('is', $record, $full_name);
                        $stmt_upload->execute();
                        if ($stmt_upload == true) {
                            echo "<script>alertInto('success','บันทึกข้อมูลเรียบร้อย','manage.php')</script>";
                        } else {
                            $cancel_record = $conn->query("delete from product where product_id = $record");
                            echo "<script>alertInto('error','บันทึกข้อมูลผิดพลาด','add_product.php')</script>";
                        }
                    }
                }
            } else {
                echo "<script>alertInto('error','บันทีกข้อมูลผิดพลาด','manage_product.php')</script>";
            }
        }
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="container-fluid container-lg" style="background-color:white; margin-top:8px; padding-top:3rem;">
            <h3 style="font-weight:bold; color:#021b39; text-align:center;">เพิ่มรายการสินค้า</h3>
            <div class="row" style="padding-left:5rem; margin-top:2rem; ">
                <div class="col-lg-12 col-sm-12" style="margin-top: 15px; margin-bottom: 10px;" id="box1">
                    <label for="product_name" class="form-label">ชื่อสินค้า</label>
                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="ระบุชื่อสินค้า">
                </div>
                <div class="col-lg-5 col-sm-5" id="box2" style="margin-right: 1rem; margin-bottom: 10px; padding-right:0% ">
                    <label for="product_type">ประเภทสินค้า</label>
                    <select class="form-select" name="product_type" id="product_type" style="width:100%;">
                        <option value="">-- เลือกรายการ --</option>
                        <option value="โน๊ตบุ๊ค">โน๊ตบุ๊ค</option>
                        <option value="คอมพิวเตอร์ตั้งโต๊ะ">คอมพิวเตอร์ตั้งโต๊ะ</option>
                        <option value="จอมอนิเตอร์">จอมอนิเตอร์</option>
                    </select>
                </div>
                <div class="col-lg-5 col-sm-5" id="box9" style="margin-right:0%; padding-right:0% ">
                    <label for="product_brand">ยี่ห้อ</label>
                    <select class="form-select" name="product_brand" id="product_brand" style="width:100%;">
                        <option value="">-- เลือกรายการ --</option>
                        <option value="Apple">Apple</option>
                        <option value="Asus">Asus</option>
                        <option value="Acer">Acer</option>
                        <option value="Dell">Dell</option>
                        <option value="HP">HP</option>
                        <option value="Lenovo">Lenovo</option>
                        <option value="LG">LG</option>
                        <option value="Microsoft">Microsoft</option>
                        <option value="MSI">MSI</option>
                        <option value="Samsung">Samsung</option>
                        <option value="ViewSonic">ViewSonic</option>
                        <option value="Xiaomi">Xiaomi</option>
                    </select>
                </div>
                <div class="col-lg-12" id="box3" style="margin-bottom: 10px;">
                    <label for="product_detail">รายละเอียด</label>
                    <textarea class="form-control" name="product_detail" id="product_detail" rows="6"></textarea>
                </div>
                <div class="col-lg-3 col-sm-4" id="box4" style="margin-left:0%; ">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">ราคาสินค้า</span>
                        </div>
                        <input type="number" class="form-control" placeholder="ระบุราคา" aria-describedby="basic-addon1" name="product_price" id="product_price">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3" id="box5">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">จำนวนสินค้า</span>
                        </div>
                        <input type="number" class="form-control" placeholder="ระบุจำนวนสินค้า" aria-describedby="basic-addon1" name="product_remain" id="product_remain" value="0">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3" id="box6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="">ค่าจัดส่ง</span>
                        </div>
                        <input type="number" class="form-control" placeholder="ระบุค่าจัดส่ง" aria-describedby="basic-addon1" name="product_delivery" id="product_delivery">
                    </div>
                </div>
                <div class="col-lg-12" id="box7" style="display: flex; flex-wrap:wrap;">
                    <input type="file" class="form-control" name="upload[]" id="product_picture" multiple="multiple" style="margin-bottom: 1rem;;">
                    <div class="alert alert-secondary" role="alert" style=""><i class="bi bi-info-circle"></i>&nbsp;
                    ควรใช้รูปขนาด 800 x 800 และขนาดไฟล์ไม่เกิน 2 MB เพื่อการแสดงผลที่เหมาะสมและลดการบีดอัดภาพ</div>
                </div>
                <br><br><br><br>
                <div class="col-lg-11" id="box6" style="display:flex; justify-content:center; padding:1rem 1rem 2rem 1rem;">
                <button class="btn btn-danger" name="btn_cancel" style="font-weight:bold ;"><a href="manage_product.php" style="text-decoration:none; font-weight:500; color:white">ยกเลิก</a></button>
                    <button class="btn btn-success" type="submit" name="btn_submit" id="btn_submit" style="font-weight:500; margin-left:0.5rem;">บันทึกข้อมูล</button>
                </div><br><br><br><br>
            </div>
        </div>
        <?php
        include 'partition/footer.php';
        ?>
    </form>
</body>

</html>