<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
    $type=$_POST['add_subcategory'];
    $language_id=$_POST['language_id'];
    $category_id=$_POST['maincat_id'];
    $subcategory_name=$_POST['name'];
    $status=1;
    $filename='';
    $allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
    if ($_FILES['image']['error'] == 0 && $_FILES['image']['size'] > 0) {
        if (!is_dir('images/lzsubcategory')) {
            mkdir('images/lzcategory', 0777, true);
        }

        $extension = pathinfo($_FILES["image"]["name"])['extension'];
        if (!(in_array($extension, $allowedExts))) {
            $response['error'] = true;
            $response['message'] = 'Image type is invalid';
            echo json_encode($response);
            return false;
        }
        $target_path = 'images/lzsubcategory/';
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $full_path)) {
            $response['error'] = true;
            $response['message'] = 'Image type is invalid';
            echo json_encode($response);
            return false;
        }
    }
    $sql = "INSERT INTO `subcategory` (`language_id`, `maincat_id`,`subcategory_name`, `type`, `image`,`status`, `row_order`) VALUES ('" . $language_id . "','".$category_id."','" . $subcategory_name . "','" . $type . "','" . $filename . "','".$status."','0')";
    if($db->sql($sql)){
        if($type==2){
              echo "<script>location.href='lzsubcategory.php';</script>";
        }
    if($type==3){
              echo "<script>location.href='ebooksubcat.php';</script>";
        }
    }
    else{
        if($type==2){
             echo "<script>location.href='lzsubcategory.php';</script>";
        }
    if($type==3){
              echo "<script>location.href='ebooksubcat.php';</script>";
        }
    }
   
?>