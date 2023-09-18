<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
$sql="select * from dailynews order by id desc";
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