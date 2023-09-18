<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
$title=$_POST['title'];
$desc=$_POST['detail'];
$sql="INSERT INTO `currentaffair` (`title`,`description`) VALUES('".$title."','".$desc."')";
if($db->sql($sql)){
   echo "<script>alert('Current Affair Inserted Successfully.');location.href='currentaffair.php';</script>";
   }
   else{
      echo "<script>alert('Current Affair not Inserted Successfully.');location.href='currentaffair.php';</script>"; 
   }
   ?>