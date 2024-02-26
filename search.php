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
    <style>
        #box_result {
            background-color: white;
            margin-top: 8px;
            padding-top: 2rem;
        }
        .row {
            justify-content: first baseline;
            align-items: center;
        }
        /* #box_product {
            margin: 1rem;
            margin-top: 0%;
        } */
        /* #card_product {
            margin: 1rem;
        }
        .card {
            width: 20rem;
        } */
        #btn_buy {
            font-weight: bolder;
        }
        .card-title {
            color: firebrick;
            font-weight: bold;

        }
        .card-text {
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
        }
        .card-text {
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            text-decoration: none;
            color: black;
        }
        .card:hover img {
            transform: scale(1.1);
        }
        #box_page {
            padding-bottom: 2rem;

        }
        #product_link {
            text-decoration: none;
            color: black;
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
    <?php
    include 'connect.php';
    $perpage = 12;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $count = ($page - 1) * $perpage;
    } else {
        $page = 1;
        $count = 0;
    }
    if (isset($_GET['search'])) {
        $keyword = "%{$_GET['search']}%";
        $check = $_GET['search'];
        if (!empty($check)) {
            $sql_search = "select * from product where (product_type like ?) or (product_id like ?) or (product_type like ?) or (product_brand like ?) or (product_name like ?) and product_status = 1 ";
            $stmt_search = $conn->stmt_init();
            $stmt_search->prepare($sql_search);
            $stmt_search->bind_param('sssss', $keyword, $keyword, $keyword, $keyword, $keyword);
            $stmt_search->execute();
            $result_search = $stmt_search->get_result();
            $total_s = $result_search->num_rows;
        } else {
            $sql_limit = "select * from product where product_status = 1  limit $count, $perpage";
            $result_search = $conn->query($sql_limit);
        }
    } elseif (isset($_GET['search1']) && isset($_GET['search2'])) {
        $keyword1 = "%{$_GET['search1']}%";
        $keyword2 =  "%{$_GET['search2']}%";
        $check = $_GET['search1'];
        $check2 = $_GET['search2'];
        if (!empty($check)) {
            $sql_search = "select * from product where (product_type like ?) and (product_brand like ?) and product_status = 1  ";
            $stmt_search = $conn->stmt_init();
            $stmt_search->prepare($sql_search);
            $stmt_search->bind_param('ss', $keyword1, $keyword2);
            $stmt_search->execute();
            $result_search = $stmt_search->get_result();
            $total_s = $result_search->num_rows;
        } else {
            $sql_limit = "select * from product where product_status = 1  limit $count, $perpage";
            $result_search = $conn->query($sql_limit);
        }
    } else {
        $sql_limit = "select * from product where product_status = 1  limit $count, $perpage";
        $result_search = $conn->query($sql_limit);
    }
    $sql_count = "select * from product where product_status = 1 ";
    $count_search = $conn->query($sql_count);
    $total = $count_search->num_rows;
    $navig = ceil($total / $perpage);
    ?>
    <form action="" method="get">
        <div class="container-fluid container-lg" id="box_result" style="padding-left: 2rem; padding-right:2rem; min-height: 80vh ;">
            <?php
            if (!empty($check)) {
                if (!empty($check2)) {
            ?>
                    <h6 style="font-weight:bold; text-align:center; margin-top:1rem;"><i class="bi bi-search">&nbsp;&nbsp;</i>ค้นหา&nbsp;&nbsp;<span style="color:darkred ;"><?php echo $check; ?></span>&nbsp;&nbsp;ยี่ห้อ&nbsp;&nbsp;<span style="color:darkred ;"><span style="color:darkred ;"><?php echo $check2; ?></span></h6>
                <?php
                } else {
                ?>
                    <h6 style="font-weight:bold; text-align:center; margin-top:1rem;"><i class="bi bi-search">&nbsp;&nbsp;</i>ค้นหา&nbsp;&nbsp;'<span style="color:darkred ;"><?php echo $check; ?></span>'</h6>
                <?php
                }
                ?>
                <div style="margin-bottom: 1rem; padding-top:2rem;">
                    <span style="color:#021b39; font-weight: bold;">ทั้งหมด <?php echo $total_s; ?> รายการ &nbsp;|&nbsp;</span>
                    <span style="color:#021b39; font-weight: bold;">จำนวน <?php if ($tt = round($total_s / 12) <= 0) {
                                                                                $total_search = 1;
                                                                            } else {
                                                                                $total_search = $tt;
                                                                            }
                                                                            echo $total_search; ?> หน้า &nbsp;|&nbsp;</span>
                    <span style="color:#021b39; font-weight: bold;">หน้าละ 12 รายการ</span>
                </div>
                <div>
                    <hr size=5>
                </div>
            <?php
            } else {
            ?>
                <div style="margin-bottom: 1rem; padding-top:2rem;">
                    <span style="color:#021b39; font-weight: bold;">ทั้งหมด <?php echo $total; ?> รายการ &nbsp;|&nbsp;</span>
                    <span style="color:#021b39; font-weight: bold;">จำนวน <?php echo round($total / 12); ?> หน้า &nbsp;|&nbsp;</span>
                    <span style="color:#021b39; font-weight: bold;">หน้าละ 12 รายการ</span>
                </div>
                <div>
                    <hr size=5>
                </div>
            <?php
            }
            ?>
            <div class="row">
                <?php
                if ($result_search->num_rows > 0) {
                    while ($data = $result_search->fetch_assoc()) {
                ?>
                        <div class="col col-xl-3 col-lg-4 col-md-6 col-sm-6" id="box_product">
                            <div class="card" id="card_product" style="padding-top: 1rem; margin-bottom:1rem;">
                                <?php
                                $picture_id = $data['product_id'];
                                $sql_picture = "select * from picture where product_id= $picture_id";
                                $result_picture = $conn->query($sql_picture);
                                $data_picture = $result_picture->fetch_assoc();
                                ?>
                                <img style="height:12rem; width:12rem; display:block; margin-left:auto; margin-right:auto; " src="upload/<?php echo $data_picture['picture_name']; ?>" class="card-img" alt="" srcset="">
                                <div class="card-body">
                                    <h6 class="card-title">&#3647;<?php echo number_format($data['product_price']); ?></h6>
                                    <p class="card-text"><a href="product.php?id=<?php echo $data['product_id']; ?>" target="_blank" id="product_link" style="font-weight:600;"><?php echo $data['product_name']; ?></a></p>
                                </div>
                            </div>
                        </div>
                <?php }
                }
                ?>
            </div><br>
            <nav aria-label="" id="box_page">
                <ul class="pagination" style="justify-content:center ;">
                    <?php
                    $previous = $page - 1;
                    if ($previous > 0) {
                    ?>
                        <li class="page-item"><a href="search.php?page=<?php echo $previous ?>" class="page-link" id="previous">Previous</a></li>
                    <?php
                    } else {
                        $previous = 1;
                    ?>
                        <li class="page-item disabled" aria-disabled="true"><a href="" class="page-link" id="previous">Previous</a></li>
                        <?php
                    }
                    for ($i = 1; $i <= $navig; $i++) {
                        if ($i == $page) {
                        ?>
                            <li class="page-item active" aria-current="page"><span class="page-link"><?php echo $i; ?></span></li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item"><a href="search.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                        <?php
                        }
                    }
                    if ($page < $navig) {
                        ?>
                        <li class="page-item"><a href="search.php?page=<?php echo $next = $page + 1;  ?>" class="page-link" id="next">Next</a></li>
                    <?php
                    } else {
                        $next = $navig;
                    ?>
                        <li class="page-item disabled" aria-disabled="true"><a href="" class="page-link" id="next">Next</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
            <span id="page_hide" style="display:none ;"><?php echo $page; ?></span>
        </div>
    </form>
    <?php include 'partition/footer.php'; ?>
</body>

</html>