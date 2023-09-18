<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
    $type=$_POST['add_subcategory2'];
    $language_id=$_POST['language_id'];
    $category_id=$_POST['subcat_id'];
    $subcategory_name=$_POST['name'];
    $status=1;
    $filename='';
    $allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
    if ($_FILES['image']['error'] == 0 && $_FILES['image']['size'] > 0) {
        if (!is_dir('images/lzsub_2category')) {
            mkdir('images/lzsub_2category', 0777, true);
        }

        $extension = pathinfo($_FILES["image"]["name"])['extension'];
        if (!(in_array($extension, $allowedExts))) {
            $response['error'] = true;
            $response['message'] = 'Image type is invalid';
            echo json_encode($response);
            return false;
        }
        $target_path = 'images/lzsub_2category/';
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $full_path)) {
            $response['error'] = true;
            $response['message'] = 'Image type is invalid';
            echo json_encode($response);
            return false;
        }
    }
    $sql = "INSERT INTO `sub_2category` (`language_id`, `subcategory_id`,`sub_2category_name`, `image`,`status`, `row_order`, `type`) VALUES ('" . $language_id . "','".$category_id."','" . $subcategory_name . "','" . $filename . "','".$status."','0','" . $type . "')";
   if($db->sql($sql)){
       if($type==2){
           echo "<script>location.href='lzsub_2category.php';</script>";
       }
       if($type==3){
           echo "<script>location.href='ebooksub_2cat.php';</script>";
       }
   }
   else{
        if($type==2){
           echo "<script>alert('Q/A Sub 2 Category Not Created Successfully.');location.href='lzsub_2category.php';</script>";
       }
       if($type==3){
           echo "<script>alert('Ebook Sub 2 Category Not Created Successfully.');location.href='ebooksub_2cat.php';</script>";
       }
   }
?>