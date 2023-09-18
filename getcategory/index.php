<?php
include('../library/crud.php');
include('../library/functions.php');
$db = new Database();
$db->connect();
// $lan = $_GET['lan'];
// $sql = "SELECT id form languages where language='$lan'";
// $db->sql($sql);
// $res = $db->getResult();
// foreach($res as $language){
//     $lan_id = $language['id'];
// }
$type=!empty($_GET['type'])?$_GET['type']:'1';
$lan_id=!empty($_GET['lan_id'])?$_GET['lan_id']:'1';
// $sql="select c.*,l.language from category c,languages l where c.language_id=l.id and c.type='$type'";

$sql = "";

if ($lan_id == '1') {
    $sql = "SELECT c.* FROM category c WHERE c.type = '$type' order by row_order asc";
} else {
    $sql = "SELECT c.* FROM category c WHERE c.language_id = '$lan_id' AND c.type = '$type' order by row_order asc";
}

// $sql = "SELECT c.* FROM category c WHERE c.language_id = '$lan_id' AND c.type = '$type'";

$db->sql($sql);
$res=$db->getResult();
$count=count($res);
header('Content-Type:application/json');
if($count>0){
   foreach($res as $question){
    $arr[]=$question;
}
echo json_encode(['error'=>false,'status'=>'Quiz Zone Category retrieved successfully','total'=>$count,'data'=>$arr]); 
}
else{
    echo json_encode(['error'=>true,'status'=>'Quiz Zone Category not retrieved successfully','total'=>$count,'data'=>'Data not found.']);
}

?>