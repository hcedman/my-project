
<?php
include 'connect.php';

if (isset($_GET['delete_id'])) {    // Delete cart list
    $delete_id = $_GET['delete_id'];
    $member_id = $_GET['member_id'];
    $sql_delete = $conn->query("delete from cart where cart_id = $delete_id");
    if ($sql_delete) {
        echo "<script>popup('success','ลบรายการสินค้าเรียบร้อย','cart.php?id=" . $member_id . "')</script>";
    } else {
        echo "<script>alertInto('error','เกิดข้อผิดพลาด','cart.php?id=" . $member_id . "')</script>";
    }
    $conn->close();
}

if (isset($_GET['email'])) {    //check email resgister
    $email = $_GET['email'];
    $sql_check = $conn->prepare("select member_email from member where member_email = ?");
    $sql_check->bind_param("s", $email);
    $sql_check->execute();
    $result_check = $sql_check->get_result();
    $count = $result_check->num_rows;
    if ($count > 0) {
        echo "0";
    } else {
        echo "1";
    }
    $conn->close();
}

if (isset($_GET['address'])) {      //edite address
    $user_id = $_GET['user_id'];
    $user_address = $_GET['address'];
    $sql_address = $conn->prepare("update member set member_address = ? where member_id = ?");
    $sql_address->bind_param("si", $user_address, $user_id);
    $sql_address->execute();
    if ($sql_address == true) {
        echo  '1';
    } else {
        echo '0';
    }
    $sql_address->close();
    $conn->close();
}

function image_resize($file_tmp, $file_name)
{
    $file_size = getimagesize($file_tmp);
    $file_new_name = rand(0, microtime(true));
    $file_extention = pathinfo($file_name, PATHINFO_EXTENSION);
    $foler_path = "upload/";
    $file_type = $file_size[2];
    if ($file_size[0] > 800 || $file_size[1] > 800) {
        $target_width = 800;
        $target_height = 800;
    } else {
        $target_width = $file_size[0];
        $target_height = $file_size[1];
    }
    switch ($file_type) {
        case IMAGETYPE_JPEG:
            $image_resource = imagecreatefromjpeg($file_tmp);
            $target_size = imagecreatetruecolor($target_width, $target_height);
            imagecopyresampled($target_size, $image_resource, 0, 0, 0, 0, $target_width, $target_height, $file_size[0], $file_size[1]);
            imagejpeg($target_size, $foler_path . $file_new_name . "." . $file_extention);
            $full_name = $file_new_name . "." . $file_extention;
            return $full_name;
            break;
        case IMAGETYPE_PNG:
            $image_resource = imagecreatefrompng($file_tmp);
            $target_size = imagecreatetruecolor($target_width, $target_height);
            imagecopyresampled($target_size, $image_resource, 0, 0, 0, 0, $target_width, $target_height, $file_size[0], $file_size[1]);
            imagepng($target_size, $foler_path . $file_new_name . "." . $file_extention);
            $full_name = $file_new_name . "." . $file_extention;
            return $full_name;
            break;
        case IMAGETYPE_GIF:
            $image_resource = imagecreatefrompng($file_tmp);
            $target_size = imagecreatetruecolor($target_width, $target_height);
            imagecopyresampled($target_size, $image_resource, 0, 0, 0, 0, $target_width, $target_height, $file_size[0], $file_size[1]);
            imagegif($target_size, $foler_path . $file_new_name . "." . $file_extention);
            $full_name = $file_new_name . "." . $file_extention;
            return $full_name;
            break;
        default:
            break;
    }
}


?>
 
