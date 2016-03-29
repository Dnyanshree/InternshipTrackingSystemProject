<?php 
session_start();
if (!isset($_SESSION['username']))
	header('Location: index.php');
else
{
	$result = $_SESSION['username']['qry'];
	if($page!="all" && $result['person_type']!=$page)
	{
		echo "NO ACCESS to ".$result['person_type'];
		exit;
	}
}