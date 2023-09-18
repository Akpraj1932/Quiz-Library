<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
$type=3;
$sql="select s3.*,s2.sub_2category_name,s.subcategory_name,c.category_name,l.language from sub_3category s3,sub_2category s2,subcategory s, category c,languages l where s3.language_id=l.id and s3.sub_2category_id=s2.id and s2.subcategory_id=s.id and s3.type='$type' and s.maincat_id=c.id";
$db->sql($sql);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'Learning Zone Sub 3 Category retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'Learning Zone Sub 3 Category not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>