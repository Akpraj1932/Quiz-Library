<?php
include('library/crud.php');
include('library/functions.php');
$id=$_GET['cat_id'];
$sub_id=$_GET['subcat_id'];
$sub_2cat_id = $_GET['sub_2cat_id'];
$lan_id = $_GET['lan_id'];

$db = new Database();
$db->connect();


$sql="select q.*,s2c.sub_2category_name,l.language,c.category_name,subc.subcategory_name from question q, sub_2category s2c,languages l,category c,subcategory subc where q.language_id = '$lan_id' and q.category='$id' and q.subcategory='$sub_id' and q.sub_2category_id='$sub_2cat_id' and s2c.id=q.sub_2category_id and q.language_id = l.id and c.id=q.category and q.subcategory= subc.id ";
//$sql="select * from subcategory where maincat_id='$id'";
$db->sql($sql);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'Questions retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'Questions not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>