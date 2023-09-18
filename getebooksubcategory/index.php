<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
$type=3;
$sql="select s.*,c.category_name,l.language from subcategory s, category c,languages l where s.language_id=l.id and s.maincat_id=c.id and c.type='$type'";
$db->sql($sql);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'Ebook Sub Category retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'Ebook Sub Category not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>