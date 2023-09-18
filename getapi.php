<?php
include('library/crud.php');
include('library/functions.php');

$db = new Database();
$db->connect();
$sql="select q.*,l.language,c.category_name,subc.subcategory_name,sub2c.sub_2category_name,sub3c.sub_3category_name from question q,languages l,category c,subcategory subc,sub_2category sub2c,sub_3category sub3c where q.language_id=l.id and q.category=c.id and q.subcategory=subc.id and q.sub_2category_id=sub2c.id and q.sub_3category_id=sub3c.id";
$db->sql($sql);
$res=$db->getResult();
header('Content-Type:application/json');
foreach($res as $question){
    $arr[]=$question;
}
echo json_encode($arr);
?>