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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/albery.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <script src="node_modules/bootstrap-input-spinner/src/bootstrap-input-spinner.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script>
    </script>
    <style>
        #container {
            background-color: white;
            margin-top: 8px;
            min-height: 75vh;
        }
        #box_image {
            padding-left: 2rem;
            padding-top: 2rem;
        }
        #box_name {
            font-size: larger;
            font-weight: bolder;
        }
        #box_price {
            font-weight:500;
            margin-left: 15px;
        }
        #span_price {
            font-size: xx-large;
            font-weight:500;
            color: maroon;
        }
        #box_delivery,
        #box_cart {
            font-size: medium;
            margin-left: 15px;
        }
        #box_quantity {
            width: 170px;
            padding-left: 0px;
        }
        #btn_cart {
            font-weight: bolder;
        }
        #box_detail {
            padding-left: 2rem;
            padding-right: 2rem;
            padding-bottom: 2rem;
        }
        #span_detail {
            padding-left: 2rem;
        }
        #box_flex {
            padding-right: 2rem;
        }
        #product_img {
            height: 400px;
            width: 400px;
        }
    </style>
    <title>Benz Online</title>
</head>

<body>
    <?php
    include 'partition/header.php';
    include 'partition/menu_index.php';
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <?php
        if (isset($_GET['id'])) {
            $sql_product = $conn->query("select * from product where product_id = '" . $_GET['id'] . "'");
            $sql_picture = $conn->query("select * from picture where product_id = '" . $_GET['id'] . "'");
            $data_product = $sql_product->fetch_assoc();
            $data_picture = $sql_picture->fetch_assoc();
        }
        ?>
        <div class="container-fluid container-lg" id="container">
            <div class="row">
                <div class="col-lg-6" id="box_image">
                    <?php
                    $product_id = $_GET['id'];
                    $sql_image = $conn->query("select * from picture where product_id = $product_id");
                    $count_pic = $sql_image->num_rows;
                    $picture_name = array();
                    ?>
                    <div class="container">
                        <div class="albery-container">
                            <div class="albery-wrapper">
                                <?php while ($data_image = $sql_image->fetch_assoc()) { ?>
                                    <div class="albery-item">
                                        <img style="width:100%; height:auto;" src="upload/<?php echo $data_image['picture_name'] ?>" alt="">
                                    </div>
                                <?php $picture_name[] = $data_image['picture_name'];
                                } ?>
                            </div>
                            <div class="move-right">
                                <a href="#" id="rightArrow"></a>
                            </div>
                            <div class="move-left">
                                <a href="#" id="leftArrow"></a>
                            </div>
                        </div>
                        <div class="pagination-container">
                            <div class="pagination-wrapper">
                                <?php
                                for ($i = 0; $i < $count_pic; $i++) { ?>
                                    <div class="pagination-item" data-item="<?php echo $i + 1; ?>">
                                        <img style="width:100px; height:100px" src="upload/<?php echo $picture_name[$i]; ?>" alt="">
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <script src="js/albery.js"></script>
                    <script>
                        $(".albery-container").albery({
                            speed: 500,
                            imgWidth: 500,
                        });
                    </script>
                </div>
                <div class="col-lg-6" id="box_flex">
                    <div class="d-flex flex-column"><br>
                        <div class="p-2 me-2" id="box_name"><?php echo $data_product['product_name']; ?></div><br><br><br><br><br>
                        <div class="p-2 me-2 bg-light" id="box_price">ราคา&nbsp;&nbsp;&nbsp;
                            <span id="span_price"><?php echo number_format($data_product['product_price']); ?></span>&nbsp;&nbsp;&nbsp;บาท
                        </div>
                        <div class="p-2 me-2 " id="box_delivery">ค่าจัดส่ง&nbsp;&nbsp;<?php echo $data_product['product_delivery'];  ?>&nbsp;&nbsp; บาท&nbsp;(ราคาขึ้นกับขนาดสินค้า)</div>
                        <div class="p-2 me-2">
                            <div class="d-flex">
                                <div class="p-2 m-2" id="box_quantity"><input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $data_product['product_remain']; ?>" step="1" /></div>
                                <div class="p-2 m-2 ">มีสินค้าทั้งหมด&nbsp;<?php echo $data_product['product_remain']; ?>&nbsp;ชิ้น</div>
                            </div>
                        </div>
                        <div class="p-2 me-2" id="box_cart"><button class="btn btn-danger btn-lg" id="btn_cart" name="btn_cart" data-id="<?php echo $data_product['product_id']; ?>">เพิ่มไปยังรถเข็น</button></div>
                    </div>
                </div>
            </div>
            <div class="row bg-light" style="margin:10px 2rem auto 2rem ;  padding-top:1rem;">
                <span style="font-weight:bolder ;">ข้อมูลจำเพาะของสินค้า</span>
            </div>
            <div class="row" style="margin:1rem 2rem 1rem 2rem;">
                <div class="col-2" style="margin-left: 1rem;">หมวดหมู่</div>
                <div class="col"><a href="search.php?search=<?php echo $data_product['product_type']; ?>" style="text-decoration: none;"><?php echo $data_product['product_type']; ?></a></div>
            </div>
            <div class="row" style="margin:1rem 2rem 1rem 2rem;">
                <div class="col-2" style="margin-left: 1rem;">ยี่ห้อ</div>
                <div class="col"><a href="search.php?search=<?php echo $data_product['product_brand']; ?>" style="text-decoration: none;"><?php echo $data_product['product_brand']; ?></a></div>
            </div>
            <div class="row" style="margin:1rem 2rem 1rem 2rem;">
                <div class="col-2" style="margin-left: 1rem;">จำนวน</div>
                <div class="col"><?php echo $data_product['product_remain']; ?></div>
            </div>
            <div class="row bg-light" style="margin:10px 2rem auto 2rem ;  padding-top:1rem;">
                <span style="font-weight:bolder ;">รายละเอียดสินค้า</span>
            </div>
            <div class="row" style="margin:1rem 2rem 1rem 2rem ; padding-bottom: 4rem;">
                <span id="span_detail"><?php echo $data_product['product_detail']; ?></span>
            </div>
        </div>
    </form>
    <?php include 'partition/footer.php';  ?>
</body>

</html>