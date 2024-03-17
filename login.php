<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit;
}
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
    <script src="script.js"> </script>
    <script language="javascript">
        $(document).ready(function() {
            $('#login_name').blur(function() {
                const loginName = $('#login_name').val();
                if (loginName !== "") {
                    $('#check_firstname').text("1");
                } else {
                    $('#check_firstname').text("0");
                }
                checkData();
            });

            $('#login_lastname').blur(function() {
                const loginLastname = $('#login_lastname').val();

                if (loginLastname !== "") {
                    $('#check_lastname').text("1");
                } else {
                    $('#check_lastname').text("0");
                }
                checkData();
            });

            $('#login_mail').blur(function() {
                var value = $('#login_mail').val();
                var data = {
                    'email': value
                };
                $.ajax({
                    url: 'function.php',
                    type: 'get',
                    data: data,
                    success: function(result) {
                        console.log(result);
                        if (result == 0) {
                            $('#available').attr('hidden', true);
                            $('#notAvailable').removeAttr('hidden');
                            $('#check_email').text("0");
                        } else if (result == 1) {
                            $('#available').removeAttr('hidden');
                            $('#notAvailable').attr('hidden', true);
                            $('#check_email').text("1");
                        } else {
                            $('#available').attr('hidden', true);
                            $('#notAvailable').attr('hidden', true);
                            $('#check_email').text("0");
                        }
                    }
                });
                checkData();
            });

            $('#login_pass').blur(function() {
                const loginPassword = $('#login_pass').val();
                if (loginPassword !== "") {
                    let lengthPassword = loginPassword.length;
                    if (lengthPassword >= 8) {
                        $("#password_hide").attr("hidden", true);
                        $('#check_password').text("1");
                    } else {
                        $("#password_hide").removeAttr('hidden');
                        $('#check_password').text("0");
                    }
                } else {
                    $('#check_password').text("0");
                }
                checkData();
            });

            function checkData() {
                var checkFirstname = $('#check_firstname').text();
                var checkLastname = $('#check_lastname').text();
                var checkEmail = $('#check_email').text();
                var checkPassword = $('#check_password').text();
                if (checkFirstname == 1 && checkLastname == 1 && checkEmail == 1 && checkPassword == 1) {
                    $('#regis').removeAttr("disabled");
                } else {
                    $('#regis').attr('disabled', 'disabled');
                }
                if ($('#login_mail').val() == "") {
                    $('#available').attr('hidden', true);
                    $('#notAvailable').attr('hidden', true);
                }
            }

            $('#reset_link').click(function() {
                alert('ยังไม่เปิดให้บริการ');
            });
        })
    </script>
    <style>
        #available,
        #notAvailable,
        #password_hide {
            margin-left: 0.5rem;
            font-size: smaller;
        }

        #register_box {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            border-color: #EAEDF1;
            border-style: solid;
            border-top: 0px;
            border-bottom: 0px;
            border-left: 0px;
        }

        #login_box {
            display: flex;
            justify-content: stretch;
            flex-direction: column;
            align-items: center;
        }
    </style>

    <title>Benz Online</title>
</head>

<body>
    <?php
    include 'partition/header.php';
    include 'partition/menu_index.php';
    $check_setting = $conn->query("select setting_value from setting where setting_id = 2");
    $result_setting = $check_setting->fetch_array();
    switch ($result_setting['setting_value']) {
        case '1':
            $permission = 1;
            break;
        case '2':
            $permission = 2;
            break;
        default:
            $permission = 1;
    }
    if (isset($_POST['btn_register'])) {
        if (isset($_POST['input_status'])) {
            $level = $permission;
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
            $query_data = $sql_login->fetch_assoc();
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
    <div class="container-fluid container-lg" style="background-color:white; margin-top:8px; padding-bottom:4rem; ">
        <br><br>
        <div class="row">
            <div class="col-12" style="text-align:center; font-weight:bold ; font-size: larger; margin-bottom:2rem;">
                <h3>สมัครสมาชิก</h3>
            </div>
        </div>
        <div class="row" id="">
            <div class="col-sm-6" id="register_box">
                <form method="POST" action="">
                    <div class="col-11" style="text-align:center; width:100%; margin: 0px auto 2rem;">
                        <h5 style="color:#566573;">ลงทะเบียนสำหรับสมาชิกใหม่</h5>
                    </div>
                    <div class="col-11">
                        <div style="margin-bottom: 15px; margin-top: 0px; padding-left:10%;">
                            <label for="login_name" class="form-label">ชื่อ</label>
                            <input type="text" class="form-control" id="login_name" placeholder="กรอกชื่อ" name="input_fname" maxlength="20">
                            <span id="check_firstname" hidden>0</span>
                        </div>
                    </div>
                    <div class="col-11">
                        <div style="margin-bottom: 15px; margin-top: 0px; padding-left:10%;">
                            <label for="login_lastname" class="form-label">นามสกุล</label>
                            <input type="text" class="form-control" id="login_lastname" placeholder="กรอกนามสกุล" name="input_lname" maxlength="20">
                            <span id="check_lastname" hidden>0</span>
                        </div>
                    </div>
                    <div class="col-11">
                        <div style="margin-bottom: 15px; margin-top: 0px; padding-left:10%;">
                            <label for="login_mail" class="form-label">อีเมลหรือชื่อผู้ใช้</label>
                            <input type="text" class="form-control" id="login_mail" placeholder="กรอกอีเมล" name="input_email" maxlength="30">
                            <span hidden id="available" style="color:darkgreen; font-weight:400;">&#10004;สามารถใช้ e-mail นี้ได้</span>
                            <span hidden id="notAvailable" style="color:darkred;  font-weight:400;">&#10006;ไม่สามารถใช้ e-mail นี้ได้</span>
                            <span id="check_email" hidden>0</span>
                        </div>
                    </div>
                    <div class="col-11">
                        <div style="margin-bottom: 15px; margin-top: 0px; padding-left:10%;">
                            <label for="login_pass" class="form-label">รหัสผ่าน</label>
                            <input type="password" class="form-control" id="login_pass" placeholder="กรอกรหัสผ่าน" name="input_pass" maxlength="20">
                            <span hidden id="password_hide" style="color:darkred; font-weight:400;">&#10006;รหัสผ่านอย่างน้อย 8 ตัว</span>
                            <span id="check_password" hidden>0</span>
                        </div>
                    </div>
                    <div class="col-11">
                        <div style="margin-bottom:20px; margin-top: 0px; padding-left:10%;">
                            <span>รหัสผ่านต้องประกอบด้วยตัวเลขหรือตัวอักษรไม่ต่ำกว่า 8 ตัว</span>
                        </div>
                    </div>
                    <div class="col-11">
                        <div style="margin-bottom: 15px; margin-top: 0px; padding-left:10%;">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="input_status">
                                <label for="" class="form-check-label">ข้าพเจ้าต้องการสิทธ์ผู้ดูแลระบบเพื่อทดลองใช้งานระบบหลังบ้าน</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div style="margin-bottom:20px; margin-top: 0px; padding-left:10%;">
                            <div class="alert alert-secondary">คำขอสิทธ์ผู้ดูแลระบบนี้ใช้เวลาอนุมัติใน 1 วันกรณีต้องการด่วนกรุณาติดต่อทางอีเมลใน resume ระหว่างรออนุมัติท่านจะอยู่ในสถานะ member ครับ</div>
                        </div>
                    </div>
                    <div class=" col-11" style="padding-bottom: 15px;">
                        <div style="padding-left:10%;">
                            <button type="submit" disabled class="btn btn-primary btn-block" id="regis" name="btn_register" style="width:100% ;">สมัครสมาชิก</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-6" id="login_box" style="padding-right:4rem; padding-left: 4rem;">
                <form method="POST" action="" style=" width:100%;">
                    <div class="col-12" style="text-align:center; width:100%; margin: 0px auto 2rem;">
                        <h5 style="color:#566573;">เข้าสู่ระบบ</h5>
                    </div>
                    <div class="col-12">
                        <div style="margin-bottom: 15px; margin-top: 0px; ">
                            <label for="login_pass" class="form-label">อีเมล</label>
                            <input type="text" class="form-control" id="login_pass" name="login_user" placeholder="กรอกอีเมลหรือชื่อผู้ใช้" maxlength="30">
                        </div>
                    </div>
                    <div class="col-12">
                        <div style="margin-bottom: 15px; margin-top: 0px; ">
                            <label for="login_pass" class="form-label">รหัสผ่าน</label>
                            <input type="password" class="form-control" id="login_pass" name="login_pass" placeholder="กรอกรหัสผ่าน" maxlength="20">
                        </div>
                    </div>
                    <div class="col-12" style="text-align:right; margin-bottom:0.5rem;"><a href="" style="text-decoration:none;" id="reset_link">ลืมรหัสผ่าน?</a></div>
                    <div class="col-12">
                        <div>
                            <button type="submit" class="btn btn-primary btn-block" id="btn_login" name="btn_login" style="width:100% ;">เข้าสู่ระบบ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <?php include 'partition/footer.php'; ?>
</body>


</html>