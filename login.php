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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <style>
    </style>

    <title>Benz Online</title>
</head>

<body>
    <?php
    include 'partition/header.php';
    include 'partition/menu_index.php';
    $z = 1;
    if (isset($_POST['btn_register'])) {
        if (isset($_POST['input_status'])) {
            $level = 2;
        } else {
            $level = 0;
        }
        $sql_register = 'insert into member (member_firstname,member_lastname,member_email,member_password,member_level)values(?,?,?,?,?)';
        $fname = $_POST['input_fname'];
        $lname = $_POST['input_lname'];
        $email = $_POST['input_email'];
        $password = $_POST['input_pass'];
        $data = array($fname, $lname, $email, $password, $level);
        $stmt_register = $conn->prepare($sql_register);
        $stmt_register->execute($data);
        if ($stmt_register) {
            $sql_login = $conn->query("select * from member where member_email= '$email' and member_password= '$password' ");
            $query_data = mysqli_fetch_assoc($sql_login);
            if ($query_data) {
                $_SESSION['user_id'] = $query_data["member_id"];
                $_SESSION['user_level'] = $query_data['member_level'];
                $_SESSION['user_name'] = $query_data['member_firstname'];
                $check_name = $query_data['member_firstname'];
                echo "<script> regisCheck('" . $check_name . "')</script>";
            } else {
                echo "<script> alertInto('error','อีเมลหรือรหัสผ่านไม่ถูกต้อง','login.php')</script>";
            }
        } else {
            echo "<script> alertInto('error','ลงทะเบียนไม่สำเร็จ โปรดลองอีกครั้ง','login.php')</script>";
        }
    } elseif (isset($_POST['btn_login'])) {
        $user_id = $_POST['login_user'];
        $user_pass = $_POST['login_pass'];
        if ($user_id !== '' && $user_pass !== '') {
            $sql_login = $conn->query("select * from member where member_email= '$user_id' and member_password= '$user_pass' ");
            $query_data = mysqli_fetch_assoc($sql_login);
            if ($query_data) {
                $_SESSION['user_id'] = $query_data["member_id"];
                $_SESSION['user_level'] = $query_data['member_level'];
                $check_name = $query_data['member_firstname'];
                echo "<script> loginCheck('" . $check_name . "')</script>";
            } else {
                echo "<script> alertInto('error','อีเมลหรือรหัสผ่านไม่ถูกต้อง','login.php')</script>";
            }
        } else {
            echo "<script> alertInto('error','กรุณาใส่ข้อมูลอีเมลล์และรหัสผ่านให้เรียบร้อย','login.php')</script>";
        }
    }
    ?>
    <a href="index2.php"></a>
    <div class="container-fluid container-lg" style="background-color:white; margin-top:8px; ">
        <br><br>
        <div class="row">
            <div class="col-12" style="text-align:center; font-weight:bold ; font-size: larger;"><span>สมัครสมาชิก</span></div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <form method="POST" action="">
                    <div class="row" style="margin-top:30px; margin-bottom:15px ;">
                        <div class="col-10" style="text-align:center ;"><span style="font-weight:bold;">ลงทะเบียนสำหรับสมาชิกใหม่</span></div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div style="margin-bottom: 15px; margin-top: 0px; padding-left:10%;">
                                <label for="login_name" class="form-label">ชื่อ</label>
                                <input type="text" class="form-control" id="login_name" placeholder="กรอกชื่อ" name="input_fname">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div style="margin-bottom: 15px; margin-top: 0px; padding-left:10%;">
                                <label for="login_lastname" class="form-label">นามสกุล</label>
                                <input type="text" class="form-control" id="login_lastname" placeholder="กรอกสกุล" name="input_lname">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div style="margin-bottom: 15px; margin-top: 0px; padding-left:10%;">
                                <label for="login_mail" class="form-label">อีเมล</label>
                                <input type="text" class="form-control" id="login_mail" placeholder="กรอกอีเมล" name="input_email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div style="margin-bottom: 15px; margin-top: 0px; padding-left:10%;">
                                <label for="login_pass" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="login_pass" placeholder="กรอกรหัสผ่าน" name="input_pass">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div style="margin-bottom:20px; margin-top: 0px; padding-left:10%;">
                                <span>รหัสผ่านต้องเป็นภาษาอังกฤษประกอบด้วยตัวพิมพ์ใหญ่อย่างน้อย 1 ตัว ตัวพิมพ์เล็กอย่างน้อย 1 ตัว และตัวเลขอย่างน้อย 1 ตัว รวมกันไม่ต่ำกว่า 8 ตัว</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div style="margin-bottom: 15px; margin-top: 0px; padding-left:10%;">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="input_status">
                                    <label for="" class="form-check-label">ข้าพเจ้าต้องการสิทธ์ผู้ดูแลระบบเพื่อทดลองใช้งานระบบหลังบ้าน</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div style="margin-bottom:20px; margin-top: 0px; padding-left:10%;">
                                <div class="alert alert-secondary">คำขอสิทธ์ผู้ดูแลระบบนี้ใช้เวลาอนุมัติใน 1 วันกรณีต้องการด่วนกรุณาติดต่อทางอีเมลใน resume ระหว่างรออนุมัติท่านจะอยู่ในสถานะ member ครับ</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-10" style="padding-bottom: 15px; padding-left:7%;">
                            <div style="padding-left:20px ;">
                                <button type="submit" class="btn btn-primary btn-block" id="regis" name="btn_register" style="width:100% ;">สมัครสมาชิก</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="d-none d-sm-flex col-1" style="display:flex; align-items:center;"><img src="img/split.jpg" alt=""></div>

            <div class="col-sm-5">
                <form method="POST" action="">
                    <div class="row" style="margin-top:30px; margin-bottom:15px ;">
                        <div class="col-10" style="text-align:center ;"><span style="font-weight:bold;">เข้าสู่ระบบ</span></div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div style="margin-bottom: 15px; margin-top: 0px; padding-left: 20px;">
                                <label for="login_pass" class="form-label">อีเมล</label>
                                <input type="text" class="form-control" id="login_pass" name="login_user" placeholder="กรอกรหัสผ่าน">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <div style="margin-bottom: 15px; margin-top: 0px; padding-left: 20px;">
                                <label for="login_pass" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="login_pass" name="login_pass" placeholder="กรอกรหัสผ่าน">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10" style="text-align:right ;"><a href="">ลืมรหัสผ่าน?</a></div>
                    </div><br>
                    <div class="row">
                        <div class="col-10">
                            <div style="padding-left:20px ;">
                                <button type="submit" class="btn btn-primary btn-block" id="btn_login" name="btn_login" style="width:100% ;">เข้าสู่ระบบ</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
<?php include 'partition/footer.php';  ?>

</html>