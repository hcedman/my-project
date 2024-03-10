<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
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
    </style>
    <title>Benz Online</title>
</head>

<body>
    <?php include 'partition/header.php';
    include 'partition/menu_index.php';
    include 'partition/menu_manage.php';
    include 'connect.php';
    $member_id = $_SESSION['user_id'];
    $sql_member = $conn->query("select * from member where member_id = $member_id ");
    $data_member = $sql_member->fetch_assoc();
    if ($data_member['member_level'] == 0) {
        $level = "Member";
    } elseif ($data_member['member_level'] == 1) {
        $level = "อยู่ระหว่างพิจารณา";
    } else {
        $level = "Admin";
    }
    if (isset($_POST['btn_submit'])) {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        if (empty($fname) || empty($lname) || empty($phone) || empty($address) || empty($password)) {
            echo "<script>alertInto('warning','กรุณาใส่ข้อมูลให้ครบถ้วน','account.php')</script>";
        } else {
            $data = array($fname, $lname, $phone, $address, $password);
            $sql_member = "update member set member_firstname=?, member_lastname=?, member_phone=?, member_address=?, member_password=? where member_id = $member_id ";
            $stmt_member = $conn->prepare($sql_member);
            $stmt_member->execute($data);
            if ($stmt_member == true) {
                echo "<script>alertInto('success','แก้ไขข้อมูลเรียบร้อย','account.php?')</script>";
            }
        }
    }
    ?>
    <div class="container-fluid container-lg" style="background-color:white; margin-top:8px; padding: 3rem; min-height: 60vh ;">
        <h3 style="font-weight:bold; margin-left:1rem; margin-bottom:3rem; text-align:center;">จัดการข้อมูลส่วนตัว</h3>
        <form action="" method="post">
           <div>
           <div class="row" style="padding-left: 2rem; margin-bottom:1rem;">
                <div class="col-lg-4" style="text-align: right;">บัญชีผู้ใช้</div>
                <div class="col-lg-5"><?php echo $data_member['member_email']; ?></div>
            </div>
            <div class="row" style="padding-left: 2rem; margin-bottom:1rem;">
                <div class="col-lg-4 col-sm-1" style="text-align: right;">ชื่อ</div>
                <div class="col-lg-5"><input type="text" class="form-control" name="fname" value="<?php echo $data_member['member_firstname']; ?>"></div>
            </div>
            <div class="row" style="padding-left: 2rem; margin-bottom:1rem;">
                <div class="col-lg-4" style="text-align: right;">นามสกุล</div>
                <div class="col-lg-5"><input type="text" class="form-control" name="lname" value="<?php echo $data_member['member_lastname']; ?>"></div>
            </div>
            <div class="row" style="padding-left: 2rem; margin-bottom:1rem;">
                <div class="col-lg-4" style="text-align: right;">เบอร์โทรศัพท์</div>
                <div class="col-lg-5"><input type="text" class="form-control" name="phone" value="<?php echo $data_member['member_phone']; ?>"></div>
            </div>
            <div class="row" style="padding-left: 2rem; margin-bottom:1rem;">
                <div class="col-lg-4" style="text-align: right;">ที่อยู่</div>
                <div class="col-lg-5"><textarea name="address" class="form-control" id="" cols="30" rows="5"><?php echo $data_member['member_address']; ?></textarea></div>
            </div>
            <div class="row" style="padding-left: 2rem; margin-bottom:1rem;">
                <div class="col-lg-4" style="text-align: right;">สถานะผู้ใช้</div>
                <div class="col-lg-5"><?php echo $level; ?></div>
            </div>
            <div class="row" style="padding-left: 2rem; margin-bottom:1rem;">
                <div class="col-lg-4" style="text-align: right;">เปลี่ยนรหัสผ่าน</div>
                <div class="col-lg-5"><input type="password" class="form-control" name="password" value="<?php echo $data_member['member_password']; ?>"></div>
            </div>
            <div class="row" style="padding-left: 2rem; margin-bottom:1rem;">
                <div class="col-lg-4" style="text-align: right;"></div>
                <div class="col-lg-2"><input type="submit" name="btn_submit" class="btn btn-success" value="บันทึกข้อมูล"></div>
            </div>
           </div>
        </form>
    </div>
    <div class="container-fluid container-lg bg-white" style="padding:1rem 0rem 3rem 4rem ;">
    </div>
    <?php include 'partition/footer.php'; ?>
</body>

</html>