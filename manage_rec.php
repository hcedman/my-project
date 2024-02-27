<?php
session_start();
if (!isset($_SESSION['user_id']) && $_SESSION['user_level'] !== 2) {
    header('location:index.php');
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
        #link1,
        #link2,
        #link3,
        #link4,
        #linkp1 {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
    </style>

    <title>Benz Online</title>
</head>

<body>
    <?php include 'partition/header.php';
    include 'partition/menu_index.php';
    include 'partition/menu_manage.php';

    require 'connect.php';
    $count_noti = $_SESSION['count_rec'];
    ?>
    <div class="container-fluid container-lg" style="background-color:white; margin-top:8px; padding: 3rem; min-height:60vh;">
        <h3 style="font-weight:bold; margin-left:1rem; margin-bottom:2rem; color:#021b39; text-align:center;">คำแนะนำบริการ</h3>
        <table class="table table-hover">
            <tbody>
                <?php
                require 'connect.php';
                $sql_rec = $conn->query("select * from recommend");
                $count_data = 0;
                while ($stmt_rec = $sql_rec->fetch_assoc()) {
                    $count_data++; ?>
                    <tr>
                        <td style="color:red; width:5%; text-align:end;"><?php if ($count_noti >= 1) {
                                                                                $count_noti--;
                                                                                echo '<i class="bi bi-exclamation-circle-fill"></i';
                                                                            } ?></td>
                        <td style="width:15%; text-align:center; font-weight:bold;"><?php echo $stmt_rec['rec_date']; ?></td>
                        <td><?php echo $stmt_rec['rec_data']; ?></td>
                    </tr>
                <?php if ($count_data == 10) {
                        break;
                    }
                }
                $update_all = $conn->query("update recommend set rec_state = 0");
                ?>
            </tbody>
        </table>
    </div>
    <?php
    ?>
    <div class="container-fluid container-lg bg-white" style="padding:1rem 0rem 3rem 4rem ;">
    </div>

    <?php include 'partition/footer.php'; ?>


</body>

</html>