<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
$sql="select * from banner_image";
$db->sql($sql);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'Banner Image retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'Banner Image not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>