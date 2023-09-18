<?php
include('library/crud.php');
include('library/functions.php');
$id=$_GET['cat_id'];
$sub_id=$_GET['subcat_id'];
$lan_id = $_GET['lan_id'];

$db = new Database();
$db->connect();


$sql="select s2c.*,l.language,c.category_name,subc.subcategory_name from sub_2category s2c,languages l,category c,subcategory subc where s2c.subcategory_id='$sub_id' and s2c.language_id = l.id and s2c.language_id='$lan_id' and c.id='$id' and subc.id='$sub_id' and subc.maincat_id='$id'";
//$sql="select * from subcategory where maincat_id='$id'";
$db->sql($sql);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'sub_2category retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'sub_2category not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>