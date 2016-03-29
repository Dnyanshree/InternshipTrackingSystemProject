<?php require '../connect.php';//if($level!='1') logout();
$id=$_GET['id'];

$stmt = $db->prepare("DELETE :id from supervisor");
$stmt->execute(array($id));

header('location:../listsupervisor.php?delete=success');

;?>
