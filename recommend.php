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
    if (isset($_POST['btn_submit']) && (!empty($_POST['rec_data']))) {
        require_once 'connect.php';
        $rec_data = array($_POST['rec_data']);
        $sql_rec = "insert into recommend (rec_data)values(?)";
        $stmt_rec = $conn->prepare($sql_rec);
        $stmt_rec->execute($rec_data);
        if ($stmt_rec == true) {
            echo "<script>alertInto('success','ขอบคุณสำหรับความคิดเห็น','recommend.php')</script>";
        }
    }
    ?>
    <div class="container-lg bg-white" style="margin-top:8px; padding: 2rem 5rem; min-height: 75vh ;">
        <h3 style="text-align: center; margin: 2rem auto 2rem;">แนะนำการบริการ</h3><br>
        <form action="" method="post">
            <div class="form-floating">
                <textarea class="form-control" name="rec_data" id="rec_data" style="height: 8rem;;"></textarea>
                <label for="rec_data">ใส่ข้อเสนอแนะเพื่อนำไปพัฒนาเว็บไซต์ต่อไป</label>
            </div>
            <div style="display: flex; justify-content:center;">
                <button type="submit" class="btn btn-success" style="margin-top:1rem;" name="btn_submit">ส่งความคิดเห็น</button>
            </div>
        </form>
    </div>
    <?php include 'partition/footer.php'; ?>
</body>

</html>