<?php require '../connect.php';//if($level!='1') logout();
$id=$_GET['id'];
$val=$_GET['val'];
echo $val;
//echo $id;exit;
$stmt = $db->prepare("UPDATE placements SET internship_complete='Y' where placement_id=? ");

$stmt->execute(array($id));

header('location:../assigninternship.php?complete=success');

;?>
