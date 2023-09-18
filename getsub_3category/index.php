<?php
include('library/crud.php');
include('library/functions.php');
$cat_name=$_GET['cat'];
$subcat_name=$_GET['subcat'];
$sub_2cat_name=$_GET['sub_2cat'];
$db = new Database();
$db->connect();
$sql="select id from category where category_name='$cat_name'";
$db->sql($sql);
$res=$db->getResult();
foreach($res as $category){
    $id=$category['id'];
}
$sql="select id from subcategory where subcategory_name='$subcat_name'";
$db->sql($sql);
$res=$db->getResult();
foreach($res as $subcategory){
    $sub_id=$subcategory['id'];
}
$sql="select id from sub_2category where sub_2category_name='$sub_2cat_name'";
$db->sql($sql);
$res=$db->getResult();
foreach($res as $sub_2cat){
    $sub_2cat_id=$sub_2cat['id'];
}

$sql="select s3c.*,l.language,c.category_name,subc.subcategory_name,s2c.sub_2category_name from sub_3category s3c, sub_2category s2c,languages l,category c,subcategory subc where s3c.sub_2category_id='$sub_2cat_id' and s2c.subcategory_id='$sub_id' and s2c.language_id = l.id and c.id='$id' and s2c.id='$sub_2cat_id' and subc.id='$sub_id' and subc.maincat_id='$id'";
//$sql="select * from subcategory where maincat_id='$id'";
$db->sql($sql);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'sub_3category retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'sub_3category not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>