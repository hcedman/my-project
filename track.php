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
    <script src="script.js"></script>
    <script>
    </script>
    <style>

    </style>
    <script>

    </script>
    <title>Benz Online</title>
</head>

<body>
    <?php include 'partition/header.php' ?>
    <?php include 'partition/menu_index.php' ?>
    <?php
    // if(isset($_POST['btn_submit'])&&(!empty($_POST['rec_data']))){
    //     require_once 'connect.php';
    //     $rec_data = array($_POST['rec_data']);
    //     $sql_rec = "insert into recommend (rec_data)values(?)";
    //     $stmt_rec = $conn->prepare($sql_rec);
    //     $stmt_rec->execute($rec_data);
    //     if($stmt_rec == true){
    //         echo "<script>alertInto('ขอบคุณสำหรับความคิดเห็น','recommend.php')</script>";
    //     }
    // }
    ?>
    <div class="container-lg bg-white" style="margin-top:8px; padding: 3rem; min-height: 75vh ;">
        <h3>ตรวจสอบคำสั่งซื้อ</h3><br>
        <form action="" method="post">
            <!-- <div class="form-floating">
                <textarea class="form-control" name="rec_data" id="rec_data" style="height: 8rem;;"></textarea>
                <label for="rec_data">ใส่ข้อเสนอแนะเพื่อนำไปพัฒนาเว็บไซต์ต่อไป</label>
            </div>
            <div>
                <button type="submit" class="btn btn-success" style="margin-top:1rem;" name="btn_submit">ส่งความคิดเห็น</button>
            </div> -->
            <div class="col-sm-12 col-lg-9 col-xl-7 col-xxl-6">
                <div class="input-group">
                    <input type="text" class="form-control" name="track_data" placeholder="input orders number">
                    <button type="submit" class="btn btn-danger" name="btn_submit">ตรวจสอบ</button>
                </div>
            </div>
        </form>
        <div class="col-sm-12 col-lg-9 col-xl-7 col-xxl-6">
            <?php
            if (isset($_POST['btn_submit']) && !empty($_POST['track_data'])) {
                require_once 'connect.php';
                $track_data = $_POST['track_data'];
                $sql_track = $conn->query("select * from orders where order_id = $track_data");
                $data_track = $sql_track->fetch_assoc();
                $count = $sql_track->num_rows;
                if ($count <= 0) { ?>

                    <div class="alert alert-primary" role="alert" style="margin-top: 2rem;">
                        <h5 style="color:red;">- <?php echo $track_data; ?> -</h5>
                        <hr>
                        <i class="bi bi-exclamation-triangle-fill"></i> &nbsp;ไม่พบข้อมูล
                    </div>

                    <?php    } else {
                    if ($data_track['order_status'] == 'finish') {
                    ?><br><br>
                        <span style="font-size:large; color:red; font-weight:bold;">หมายเลขสั่งซื้อ : <?php echo  $data_track['order_id']; ?> </span><br>
                        <span style="font-size: small; font-weight:bold;">วันที่สั่งซื้อ : <?php echo $data_track['order_date']; ?></span><br><br>
                        <span style="font-size:large ;">สถานะคำสั่งซื้อ : </span>
                        <span style="font-size: large; color:forestgreen"> จัดส่งเรียบร้อย</span><br><br>
                        <table style="width: 100%; margin-bottom:3rem;">
                            <tr>
                                <td style="border-bottom:forestgreen; border-style:solid;"><i class="bi bi-receipt" style="font-size:xx-large; color:forestgreen;"></i></td>
                                <td style="border-bottom:forestgreen; border-style:solid;"><i class="bi bi-truck" style="font-size:xx-large; color:forestgreen;"></i></td>
                                <td style="border-bottom:forestgreen; border-style:solid;"><i class="bi bi-card-checklist" style="font-size:xx-large; color:forestgreen;"></td>
                            </tr>
                            <tr>
                                <td><span style="color:gray;">คำสั่งซื้อใหม่</span></td>
                                <td><span style="color:gray;">อยู่ระหว่างดำเนินการ</span></td>
                                <td><span style="font-weight: bolder;">จัดส่งเรียบร้อย</span></td>
                            </tr>
                        </table>
                    <?php
                    } elseif ($data_track['order_status'] == 'inprogress') {
                    ?><br><br>
                        <span style="font-size:large; color:red; font-weight:bold;">หมายเลขสั่งซื้อ : <?php echo  $data_track['order_id']; ?> </span><br>
                        <span style="font-size: small; font-weight:bold;">วันที่สั่งซื้อ : <?php echo $data_track['order_date']; ?></span><br><br>
                        <span style="font-size:large ;">สถานะคำสั่งซื้อ : </span>
                        <span style="font-size: large; color:forestgreen"> อยู่ระหว่างดำเนินการ</span><br><br>
                        <table style="width: 100%; margin-bottom:3rem;">
                            <tr>
                                <td style="border-bottom:forestgreen; border-style:solid;"><i class="bi bi-receipt" style="font-size:xx-large; color:forestgreen;"></i></td>
                                <td style="border-bottom:forestgreen; border-style:solid;"><i class="bi bi-truck" style="font-size:xx-large; color:forestgreen;"></i></td>
                                <td style="border-bottom:gray; border-style:dashed"><i class="bi bi-card-checklist" style="font-size:xx-large; color:gray;"></td>
                            </tr>
                            <tr>
                                <td><span style="color:gray;">คำสั่งซื้อใหม่</span></td>
                                <td><span style="font-weight: bolder;">อยู่ระหว่างดำเนินการ</span></td>
                                <td><span style="color:gray;">จัดส่งเรียบร้อย</span></td>
                            </tr>
                        </table>
                    <?php

                    } else {
                    ?><br><br>
                        <span style="font-size:large; color:red; font-weight:bold;">หมายเลขสั่งซื้อ : <?php echo  $data_track['order_id']; ?> </span><br>
                        <span style="font-size: small; font-weight:bold;">วันที่สั่งซื้อ : <?php echo $data_track['order_date']; ?></span><br><br>
                        <span style="font-size:large ;">สถานะคำสั่งซื้อ : </span>
                        <span style="font-size: large; color:red;"> ยกเลิกคำสั่งซื้อ</span><br><br>
                        <table style="width: 100%; margin-bottom:3rem;">
                            <tr>
                                <td style="border-bottom:red; border-style:solid;"><i class="bi bi-x-circle" style="font-size:xx-large; color:red;"></i></td>
                                <td style="border-bottom:gray; border-style:dashed;"><i class="bi bi-truck" style="font-size:xx-large; color:gray;"></i></td>
                                <td style="border-bottom:gray; border-style:dashed"><i class="bi bi-card-checklist" style="font-size:xx-large; color:gray;"></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bolder;">ยกเลิกรายการ</span></td>
                                <td><span style="color:gray;">อยู่ระหว่างดำเนินการ</span></td>
                                <td><span style="color:gray;">จัดส่งเรียบร้อย</span></td>
                            </tr>
                        </table>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
    <?php include 'partition/footer.php'; ?>
</body>

</html>