<?php
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=datadiggers', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM internship WHERE job_title LIKE (:keyword) ORDER BY internship_id ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$job_title = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['job_title']);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['job_title']).'\')">'.$job_title.'</li>';
}
?>