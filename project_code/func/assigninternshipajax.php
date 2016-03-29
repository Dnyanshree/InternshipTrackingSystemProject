<?php require '../connect.php';//if($level!='1') logout();
$id=$_GET['id'];
$val=$_GET['val'];
echo $val;
//echo $id;exit;
if($val==1)
	$stmt = $db->prepare("UPDATE placements SET internship_placed='Y' where placement_id=? ");
else
	$stmt = $db->prepare("UPDATE placements SET internship_placed='R' where placement_id=? ");

$stmt->execute(array($id));

header('location:../assigninternship.php?assign='.$val);

;?>
