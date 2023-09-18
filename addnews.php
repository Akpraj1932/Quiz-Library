<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
$title=$_POST['title'];
$desc=$_POST['detail'];
$sql="INSERT INTO `dailynews` (`title`,`description`) VALUES('".$title."','".$desc."')";
if($db->sql($sql)){
   echo "<script>alert('News Inserted Successfully.');location.href='daily-news.php';</script>";
   }
   else{
      echo "<script>alert('News not Inserted Successfully.');location.href='daily-news.php';</script>"; 
   }
   ?>