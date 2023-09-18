<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
$type=3;
$sql="select c.*,l.language from category c,languages l where c.language_id=l.id and c.type='$type'";
$db->sql($sql);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'Ebook Category retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'Ebook Category not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>