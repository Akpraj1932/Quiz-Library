<?php
include('../library/crud.php');
include('../library/functions.php');
$db = new Database();
$db->connect();

$sql="select * from currentaffair";
$db->sql($sql);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'Current Affair retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'Current Affair not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}
?>