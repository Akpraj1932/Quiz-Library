<?php
include('../library/crud.php');
include('../library/functions.php');
$db = new Database();
$db->connect();
$sql="select tl.*,l.language,c.category_name,s.subcategory_name,s2b.sub_2category_name,s3b.sub_3category_name from tbl_learning tl, category c,languages l,subcategory s,sub_2category s2b,sub_3category s3b where tl.language_id=l.id and tl.category=c.id and tl.subcategory_id=s.id and tl.sub_2category_id=s2b.id and tl.sub_3category_id=s3b.id";

$query ="select e.*,l.language,c.category_name,subc.subcategory_name,sub2c.sub_2category_name,sub3c.sub_3category_name from tbl_learning e left join languages l on e.language_id=l.id left join category c on e.category=c.id left join subcategory subc on e.subcategory_id=subc.id left join sub_2category sub2c on e.sub_2category_id=sub2c.id left join sub_3category sub3c on e.sub_3category_id=sub3c.id";

$db->sql($query);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'Question And Answer retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'Question And Answer not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>