<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include('../library/crud.php');
include('../library/functions.php');
$db = new Database();
$db->connect();
$type=3;
$sql="select e.*,l.language,c.category_name,subc.subcategory_name,sub2c.sub_2category_name,sub3c.sub_3category_name from ebook e,languages l,category c,subcategory subc,sub_2category sub2c,sub_3category sub3c where e.language_id=l.id and e.category_id=c.id and e.subcategory_id=subc.id and e.sub_2category_id=sub2c.id and e.sub_3category_id=sub3c.id and e.type='$type'";
$query ="select e.*,l.language,c.category_name,subc.subcategory_name,sub2c.sub_2category_name,sub3c.sub_3category_name from ebook e left join languages l on e.language_id=l.id left join category c on e.category_id=c.id left join subcategory subc on e.subcategory_id=subc.id left join sub_2category sub2c on e.sub_2category_id=sub2c.id left join sub_3category sub3c on e.sub_3category_id=sub3c.id where e.type='$type'";
$db->sql($query);
$res=$db->getResult();
$count=count($res);
// print_r($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}

echo json_encode(['error'=>false,'status'=>'Ebook retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'Ebook not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>