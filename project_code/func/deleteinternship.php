<?php require '../connect.php';//if($level!='1') logout();
$internshipid=$_GET['id'];

mysqli_query($link,"CALL sp_Delete_Internship($internshipid)");

header('location:../listinternships.php?delete=success');

;?>
