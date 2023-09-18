<?php
include('library/crud.php');
include('library/functions.php');
$id=$_GET['cat_id'];
$db = new Database();
$db->connect();

$sql="select subc.*,l.language,c.category_name from subcategory subc,languages l,category c where subc.maincat_id=c.id and subc.language_id = l.id and subc.maincat_id='$id'";
//$sql="select * from subcategory where maincat_id='$id'";
$db->sql($sql);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'subcategory retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'subcategory not retrieved successfully','total'=>$count,'data'=>[]]);
}

?>