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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
    </script>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
    </script>
    <script type="text/javascript">
        (function() {
            emailjs.init("7mWdj2BiDPzUpayk7");
        })();
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
    <div class="container-lg bg-white" style="margin-top:8px; padding: 2rem 2rem 6rem 2rem; min-height: 75vh ;">
        <h3 style="text-align: center; margin: 2rem auto 2rem;">เกี่ยวกับเรา</h3>
        <div class="container">
            <div class="container border mt-3 bg-light;">
                <div class="row" style="">
                    <div class="col-md-6 text-white" style="padding: 1rem 2rem 2rem 2rem; background: #021b39; ">
                        <img src="img/thankyou.jpg" class="img-fluid" alt="" style="padding: 1rem 6rem; border-radius: 50%;">
                        <h4 style="text-align: center;">ขอบคุณสำหรับการเข้ามาเยี่ยมชม</h4>
                        <span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            เว็บไซต์นี้จัดทำขึ้นสำหรับทดสอบโปรเจคระบบร้านค้าออนไลน์เท่านั้นไม่มีวัตถุประสงค์เชิงพานิชญ์ใดๆทั้งสิ้น
                            ฉะนั้นผู้ใช้งานไม่จำเป็นต้องใส่ข้อมูลส่วนตัวและที่อยู่จริงๆ เพื่อสมัครสมาชิกหรือสั่งซื้อสินค้ากับเว็บไซต์
                            </span>
                    </div>
                    <div class="col-md-6 border-left py-3" style="padding: 3rem 2rem 2rem; ">
                        <h3 style="margin-top: 1rem;">Contact form</h3>
                        <div class="form-group" style="margin-top: 1rem;">
                            <h5 for="name">Name :</h5>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" />
                        </div>
                        <div class="form-group" style="margin-top: 1rem;">
                            <h5 for="message">Message :</h5>
                            <textarea class="form-control" id="message" rows="5" placeholder="Enter message to website owner"></textarea>
                        </div>
                        <button class="btn" onclick="sendMail()" style="margin: 1rem auto; background-color:#021b39; color:white;">Send E-mail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'partition/footer.php'; ?>
</body>

</html>








Hello {{to_name}},

You got a new message from {{from_name}}:

{{message}}

Best wishes,
EmailJS team