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
<div class="container-lg bg-white" style="margin-top:8px; padding: 2rem 3rem; min-height: 75vh ;">
    <h3 style="text-align: center; margin: 2rem auto 3rem;">การรับประกันสินค้า</h3>
    <div class="alert alert-secondary " role="alert" style="margin-top: 1rem;;">
    <span style="font-weight: bold;">สินค้าที่เปิดขายออกไปไม่เกิน 7 วัน (นับแต่วันที่ได้รับสินค้า) และลูกค้า มีความประสงค์ ในการขอคืนสินค้า โดยสินค้าไม่เสีย / ลูกค้าขอยกเลิก / สั่งสินค้าผิด แบ่งออกเป็น 2 กรณี</span><br>
    1. กรณีสภาพสินค้าสมบูรณ์ อุปกรณ์ครบถ้วนตามที่เปิดขายออกไปทุกประการ รวมถึงกล่องอุปกรณ์ต้องไม่มีร่องรอยความเสียหาย ในกรณีที่ มีการคืนสินค้า แบบขอคืนเงิน ทางบริษัทยินดีคืนเงินเต็มจำนวน และไม่หักค่าธรรมเนียมการโอน <br>
    2. กรณีสภาพสินค้าไม่สมบูรณ์ อุปกรณ์ไม่ครบถ้วนตามที่เปิดขายออกไปทุกประการ รวมถึงกล่องอุปกรณ์มีร่องรอยความสูญหาย ในกรณีที่มี การคืนสินค้า แบบขอคืนเงิน ทางลูกค้าจะถูกหักค่าบริการ 5% - 25% จากราคาของตัวสินค้านั้นๆ และทางบริษัท จะหักค่าธรรมเนียมการโอนตาม จริง
    “ ผู้บริโภคมีสิทธิ์คืนสินค้า ในสภาพสมบูรณ์ภายใน 7 วัน นับแต่วันที่ได้รับสินค้า โดยแจ้งมายังช่องทางของบริษัท และบริษัทยินดีคืนเงินเต็มจำนวน ภายใน 15 วัน นับแต่วันที่ได้รับหนังสือแสดงเจตนา ”
    </div>
</div>

    <?php include 'partition/footer.php'; ?>
</body>

</html>