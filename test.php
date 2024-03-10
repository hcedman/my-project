<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/albery.css" type="text/css">
<style>
</style>
  <title>Document</title>
</head>
<body>
  <?php
  if(isset($_POST['submit'])){
    $file = $_FILES['file']['tmp_name'];
    $file_name = $_FILES['file']['name'];
    echo print_r($file);
    if($new_file = image_resizing($file, $file_name)){
       echo "<br>".$new_file;
    }
  }

  function image_resizing($file, $file_name){
    $file_size = getimagesize($file);
    $file_new_name = time();
    $file_extention = pathinfo($file_name, PATHINFO_EXTENSION);
    $foler_path = "upload/";
    $image_resource = imagecreatefromjpeg($file);
    $image_resize = imagecreatetruecolor(500,500);
    imagecopyresampled($image_resize, $image_resource,0,0,0,0,600,600,$file_size[0], $file_size[1]);
    imagejpeg($image_resize, $foler_path.$file_new_name.".". $file_extention );
    $finally_name = $file_new_name.".".$file_extention;
    return $finally_name;
  }
?>
  <!-- ///////////////////////////TEST CODE ONLY////////////////////////////// -->
  <form action="" method="post" enctype="multipart/form-data">
    <div class="container-lg bg-secondary" style="display:flex; justify-content:center; padding:3rem; border-radius:15px; flex-direction:column; align-items:center; margin-top: 1rem;">
      <div class="col-5">
        <input type="file" name="file" id="file" class="form-control">
      </div>
      <div>
        <button class="btn btn-success" name="submit" style="margin-top:2rem;">Upload</button>
      </div>
    </div>

  </form>



















  <!-- ///////////////////////////TEST CODE ONLY////////////////////////////// -->
</body>
<script>
  //     $(document).ready(function() {
  //     $('#input1').change(function() {
  //         alert("hello");
  //         // let value = $('#input1').val();
  //         var text = $('#input1').val();
  //         var email = { 'email':text };
  //         $.ajax({
  //             url:'function.php',
  //             type: 'get',
  //             data: email,
  //             success: function(result) {
  //                 alert(result);
  //                 // if(result == 1){
  //                 //     $('#available').removattreAttr('hidden');
  //                 //     $('#notAvailable').removeAttr('hidden');
  //                 // }else{
  //                 //     $('#available').attr('hidden');
  //                 //     $('#notAvailable').removeAttr('hidden');
  //                 // }
  //             }

  //         })
  //     })
  // })
</script>

</html>