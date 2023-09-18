<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Questions for Quiz |- Admin Panel </title>
        <?php include 'include-css.php'; ?>
    </head>
<body>
	<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
<?php
include('library/crud.php');
include('library/functions.php');
$db = new Database();
$db->connect();
$id=$_GET['id'];
$sql="select ebookpdf from ebook where id='$id'";
$db->sql($sql);
$res=$db->getResult();
foreach($res as $ebook){
	?>
	<embed type="application/pdf" src="<?php echo $ebook['ebookpdf'];?>" width="1400" height="740"></embed>
<?php }
?>
	</div>
</div>
</body>
</html>