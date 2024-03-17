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
        $(document).ready(function() {
            $('#flexRadioDefault1').click(function() {
                var typeSelector = $('#flexRadioDefault1').val();
                productSugges(typeSelector);
                saveConfig();
            });
            $('#flexRadioDefault2').click(function() {
                var typeSelector = $('#flexRadioDefault2').val();
                productSugges(typeSelector);
                saveConfig();
            });
            $('#flexRadioDefault3').click(function() {
                var typeSelector = $('#flexRadioDefault3').val();
                productSugges(typeSelector);
                saveConfig();
            });

            $('#switchPermission').click(function() {
                var permissionSelector = $('#permission_value').text();
                if (permissionSelector == '1') {
                    var value_permi = '2';
                } else if (permissionSelector == '2') {
                    var value_permi = '1';
                }
                var data = {
                    'permiConfig': value_permi
                }
                $.ajax({
                    url: 'function.php',
                    type: 'get',
                    data: data,
                    success: function(result) {
                        permissionSelector = $('#permission_value').text(value_permi);
                        saveConfig();
                    }
                });
            });

            function productSugges(typeSelector) {
                var data = {
                    'typeConfig': typeSelector
                };
                $.ajax({
                    url: 'function.php',
                    type: 'get',
                    data: data,
                    success: function(result) {
                        console.log(result);
                    }
                });
            }

            function saveConfig() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "บันทึกตั้งค่าเรียบร้อย"
                });
            }

            var typeValue = $('#type_value').text();
            console.log(typeValue);
            switch (typeValue) {
                case '1':
                    $('#flexRadioDefault1').attr('checked', true);
                    $('#flexRadioDefault2').attr('checked', false);
                    $('#flexRadioDefault3').attr('checked', false);
                    break;
                case '2':
                    $('#flexRadioDefault1').attr('checked', false);
                    $('#flexRadioDefault2').attr('checked', true);
                    $('#flexRadioDefault3').attr('checked', false);
                    break;
                case '3':
                    $('#flexRadioDefault1').attr('checked', false);
                    $('#flexRadioDefault2').attr('checked', false);
                    $('#flexRadioDefault3').attr('checked', true);
                    break;
            }

            var permissionValue = $('#permission_value').text();
            switch (permissionValue) {
                case '1':
                    $('#switchPermission').attr('checked', false);
                    break;
                case '2':
                    $('#switchPermission').attr('checked', true);
                    break;
            }

        });
    </script>
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
    include 'partition/menu_manage.php'; ?>
    <div class=" container-fluid container-lg bg-white" style="min-height:70vh; margin-top:8px; padding: 3rem 3rem 5rem;">

        <h3 style="font-weight:bold; margin-left:1rem; margin-top:rem; margin-bottom:2rem; text-align:center;">ตั้งค่าเว็บไซต์</h3>
        <h5 style="margin-bottom: 1rem;;">ตั้งค่าทั่วไป</h5>
        <div style="display: flex;">

            <div style="border:solid 1px gray; padding:1.5rem; border-radius:20px; background-color:ghostwhite;">
                <h5 style="color:gray;">ประเภทสินค้าแนะนำที่หน้าแรก</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        แนะนำสินค้าเหลือเยอะ
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        แนะนำสินค้าเหลือน้อย
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" value="3">
                    <label class="form-check-label" for="flexRadioDefault3">
                        แนะนำสินค้าแบบสุ่ม
                    </label>
                </div>
                <?php
                $sql_current_type = $conn->query("select setting_value from setting where setting_id = 1");
                $stmt_current_type = $sql_current_type->fetch_assoc();
                $current_type_value =  $stmt_current_type['setting_value'];
                ?>
                <span id="type_value" hidden><?php echo $current_type_value ?></span>
            </div>
            <div style="border:solid 1px gray; padding:1.5rem; border-radius:20px; background-color:ghostwhite; margin-left:1rem;">
                <h5 style="color:gray;">กำหนดสิทธ์ผู้ใช้งาน</h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="switchPermission" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">อนุญาติให้ผู้ใช้ขอสิทธ์ admin ได้โดยไม่ต้องรอการอนุมัติ</label>
                </div>
                <?php
                $sql_current_permission = $conn->query("select setting_value from setting where setting_id = 2");
                $stmt_current_permission = $sql_current_permission->fetch_assoc();
                $current_permission_value =  $stmt_current_permission['setting_value'];
                ?>
                <span id="permission_value" hidden><?php echo $current_permission_value ?></span>
            </div>
        </div>
    </div>

    </div>
    <?php include 'partition/footer.php'; ?>

</body>

</html>