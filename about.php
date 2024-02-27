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
    <div class="container-lg bg-white" style="margin-top:8px; padding: 3rem; min-height: 75vh ;">
        <h3>เกี่ยวกับเรา</h3>
        <div class="alert alert-secondary " role="alert" style="margin-top: 1rem;;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เว็บไซต์นี้จัดทำขึ้นสำหรับทดสอบโปรเจคระบบร้านค้าออนไลน์เท่านั้นไม่มีวัตถุประสงค์เชิงพานิชญ์ใดๆทั้งสิ้น ฉะนั้นผู้ใช้งานไม่จำเป็นต้องใส่ข้อมูลส่วนตัวและที่อยู่จริงๆ เพื่อสมัครสมาชิกหรือสั่งซื้อสินค้ากับเว็บไซต์
        </div>
    </div>

    <?php include 'partition/footer.php'; ?>
</body>

</html>