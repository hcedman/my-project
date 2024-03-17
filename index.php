<?php
session_start();
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
    <script>
    </script>
    <style>
        #box_product {
            margin-bottom: 1rem;
        }

        .card-text {
            font-weight: 400;
            white-space: nowrap;
            overflow: hidden;
            text-decoration: none;
            color: black;
        }

        .card:hover img {
            transition: 0.5s;
            transform: scale(1.1);
        }

        #brand_box {
            background-color: #EAF2F8;
            margin: 0%;
            padding: 0.5rem 0.2rem;
            border-style: solid;
            border-color: #021b39;
            border-width: 5px;
            border-top: 0px;
            border-bottom: 0px;
            height: auto;
        }

        #brand1,
        #brand2,
        #brand3,
        #brand4,
        #brand5,
        #brand6,
        #brand7,
        #brand8,
        #brand9,
        #brand10,
        #brand11,
        #brand12 {
            padding: 3px;
            margin: 0%;
        }

        #brand_img {
            width: 100%;
            height: auto;
            padding: 1px;
        }

        #brand_img:hover {
            transition: 0.4s;
            transform: scale(1.2);
            box-shadow: #2D3034;
            filter: drop-shadow(3px 2px 2px #53637F);
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.card').on({
                mouseenter: function() {
                    $(this).css("box-shadow", "0 0 4px #778899");

                },
                mouseleave: function() {
                    $(this).css("box-shadow", "0 0 0 0");
                }
            });
        });
    </script>
    <title>Benz Online</title>
</head>

<body>
    <?php include 'partition/header.php' ?>
    <?php include 'partition/menu_index.php' ?>

    <div class="container-lg" id="slide" style="padding-left:0%; padding-right:0%; ">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/Banner01.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/Banner02.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/Banner03.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container-lg bg bg-white" style="padding: 0%;">
        <div class="row" id="brand_box">
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand1"><a href="search.php?search1=apple" target="_blank"><img id="brand_img" src="img/brand/apple.jpg" alt=""></a></div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand2"><a href="search.php?search1=microsoft" target="_blank"><img id="brand_img" src="img/brand/microsoft.jpg" alt=""></a></div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand3"><a href="search.php?search1=asus" target="_blank"><img id="brand_img" src="img/brand/asus.jpg" alt=""></a></div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand4"><a href="search.php?search1=acer" target="_blank"><img id="brand_img" src="img/brand/acer.jpg" alt=""></a></div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand5"><a href="search.php?search1=lenovo" target="_blank"><img id="brand_img" src="img/brand/lenovo.jpg" alt=""></a></div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand6"><a href="search.php?search1=msi" target="_blank"><img id="brand_img" src="img/brand/msi.jpg" alt=""></a></div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand7"><a href="search.php?search1=xiaomi" target="_blank"><img id="brand_img" src="img/brand/xiaomi.jpg" alt=""></a></div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand8"><a href="search.php?search1=dell" target="_blank"><img id="brand_img" src="img/brand/dell.jpg" alt=""></a></div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand9"><a href="search.php?search1=lg" target="_blank"><img id="brand_img" src="img/brand/lg.jpg" alt=""></a></div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand10"><a href="search.php?search1=hp" target="_blank"><img id="brand_img" src="img/brand/hp.jpg" alt=""></a></div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand11"><a href="search.php?search1=samsung" target="_blank"><img id="brand_img" src="img/brand/samsung.jpg" alt=""></a></div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-2 col-xl-2" id="brand12"><a href="search.php?search1=viewsonic" target="_blank"><img id="brand_img" src="img/brand/viewsonic.jpg" alt=""></a></div>
        </div>
    </div>
    <div class="container-lg bg-white">
        <div style="padding-top: 1rem; padding-bottom:1rem;">
            <div class="row">
                <div class="col-lg-6" style="text-align:left;"><span style="color:#021b39; font-weight: bolder; font-size: large;">&nbsp;สินค้าแนะนำ</span></div>
                <div class="col-lg-6" style="text-align:right;"><a href="search.php" style="text-decoration: none; color:#021b39; font-weight: bolder; font-size: large;">View All ></a></div>
            </div>
        </div>
        <div class="row">
            <?php
            require 'connect.php';
            $check_setting = $conn->query("select setting_value from setting where setting_id = 1");
            $result_setting = $check_setting->fetch_array();
            switch ($result_setting['setting_value']) {
                case '1':
                    $sql_value = "select * from product order by product_remain desc limit 4";
                    break;
                case '2':
                    $sql_value = "select * from product order by product_remain asc limit 4";
                    break;
                case '3';
                    $sql_value = "select * from product order by rand() limit 4";
                    break;
                default:
                    $sql_value = "select * from product order by rand() limit 4";
            }

            $sql_product = $conn->query($sql_value);
            while ($data_product = $sql_product->fetch_assoc()) {
                $product_id = $data_product['product_id'];
                $sql_picture = $conn->query("select picture_name from picture where product_id = $product_id limit 1 ");
                $data_picture = $sql_picture->fetch_assoc();
            ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" id="box_product">
                    <div class="card" id="card_product" style="padding-top: 1rem;"><a href="product.php?id=<?php echo $data_product['product_id']; ?>">
                            <img style="height:12rem; width:12rem; display:block; margin-left:auto; margin-right:auto; " src="upload/<?php echo $data_picture['picture_name']; ?>" class="card-img" alt="" srcset=""></a>
                        <div class="card-body">
                            <h6 class="card-title" style="color:crimson; ;">&#3647; <?php echo number_format($data_product['product_price']); ?></h6>
                            <p class="card-text" style="text-overflow: ellipsis;"><a href="product.php?id=<?php echo $data_product['product_id']; ?>" style="text-decoration: none; font-size:small; color:#2D3034;" target="_blank"><?php echo $data_product['product_name']; ?></a></p>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div><br><br>
    </div>
    <?php include 'partition/footer.php'; ?>
</body>

</html>