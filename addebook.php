<?php 

include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
    $language_id=$_POST['language_id'];
    $category=$_POST['category'];
    $subcategory=$_POST['subcategory'];
    $sub_2category=$_POST['sub_2category'];
    $sub_3category=$_POST['sub_3category'];
    $filename=$_FILES['uploadfile']['name'];
    $tempname = $_FILES["uploadfile"]['tmp_name'];
    $type=$_POST['add_question'];
    $title =$_POST['title'];
   
   function checkFileExtension($ext){
    if ($ext == 'pdf' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'doc' || $ext == 'docx' || $ext == 'ppt' || $ext == 'pptx' || $ext == 'txt') {
        $pass = (int)1;
    } else {
        $pass = (int)0;
    }
    return (int)$pass;}


    $ext = substr(strrchr($_FILES['uploadfile']['name'], "."), 1);
    $fileAccepted = checkFileExtension($ext);

if($fileAccepted==1){
   $folder = "images/ebookpdf/".$filename;
    $sql="INSERT INTO `ebook`(`language_id`,`category_id`,`subcategory_id`,`sub_2category_id`,`sub_3category_id`,`ebookpdf`,`type`,`title`) VALUES('".$language_id."','".$category."','".$subcategory."','".$sub_2category."','".$sub_3category."','".$folder."','".$type."','".$title."')";
    if($db->sql($sql)){
        move_uploaded_file($tempname,$folder);
        echo "<script>location.href='ebook.php';</script>";
    }
    else{
        echo "<script>alert('Not Added.');location.href='ebook.php';</script>";
    }
}else{
     echo "<script>alert('upload only PDF/TXT/PPT/Doc format file');alert($tempname);location.href='ebook.php';</script>";
}


?>