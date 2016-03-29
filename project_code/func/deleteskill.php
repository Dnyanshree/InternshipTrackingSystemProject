<?php require '../connect.php';//if($level!='1') logout();
$id=$_GET['id'];

$stmt = $db->prepare("DELETE :id from skill");
$stmt->execute(array($id));

header('location:../skilllist.php?delete=success');

;?>
