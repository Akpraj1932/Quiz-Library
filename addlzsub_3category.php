<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
    $type=$_POST['add_subcategory3'];
    $language_id=$_POST['language_id'];
    $category_id=$_POST['sub_2category_id'];
    $subcategory_name=$_POST['name'];
    $status=1;
    $filename='';
    $allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
    if ($_FILES['image']['error'] == 0 && $_FILES['image']['size'] > 0) {
        if (!is_dir('images/lzsub_3category')) {
            mkdir('images/lzsub_3category', 0777, true);
        }

        $extension = pathinfo($_FILES["image"]["name"])['extension'];
        if (!(in_array($extension, $allowedExts))) {
            $response['error'] = true;
            $response['message'] = 'Image type is invalid';
            echo json_encode($response);
            return false;
        }
        $target_path = 'images/lzsub_3category/';
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $full_path)) {
            $response['error'] = true;
            $response['message'] = 'Image type is invalid';
            echo json_encode($response);
            return false;
        }
    }
    $sql = "INSERT INTO `sub_3category` (`language_id`, `sub_2category_id`,`sub_3category_name`, `image`,`status`, `row_order`, `type`) VALUES ('" . $language_id . "','".$category_id."','" . $subcategory_name . "','" . $filename . "','".$status."','0','" . $type . "')";
   if($db->sql($sql)){
       if($type==2){
           echo "<script>alert('Q/A Sub 3 Category Created Successfully.');location.href='lzsub_3category.php';</script>";
       }
       if($type==3){
           echo "<script>alert('Ebook Sub 3 Category Created Successfully.');location.href='ebooksub_3cat.php';</script>";
       }
   }
   else{
        if($type==2){
           echo "<script>alert('Q/A Sub 3 Category Not Created Successfully.');location.href='lzsub_3category.php';</script>";
       }
       if($type==3){
           echo "<script>alert('Ebook Sub 3 Category Not Created Successfully.');location.href='ebooksub_3cat.php';</script>";
       }
   }
?>