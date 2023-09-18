<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
$sql="select * from dailynews where maincat_id='".$_GET['cat_id']."'";
$db->sql($sql);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'News retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'News not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>