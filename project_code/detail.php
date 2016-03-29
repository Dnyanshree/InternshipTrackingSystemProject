

<!DOCTYPE html>
<html>

<head>

</head>
<body>

<?php 
require('connect.php');
	session_start();
	$person_id=$_SESSION['person_id'];
	

	$q = $db->query("SELECT student_id FROM student WHERE person_id='".$person_id."'");
  	$f = $q->fetch();
  	$student_id = $f['student_id'];
  	
if(isset($_GET["id"]))
{


	$stmt = $db->prepare("SELECT * FROM internship as I, business as B WHERE B.business_id=I.business_id AND I.internship_id = :internship_id
		");
	$stmt->execute(array(':internship_id' => $_GET["id"]));
	$row = $stmt->fetch();

	$internship_id=$row["internship_id"];
	
	echo"<pre>";
	echo "business_name".$row["business_name"]."\n";
	echo "business_type ".$row["business_type"]."\n";
	echo "job_title ".$row["job_title"]."\n";
	echo "contact_name ".$row["contact_name"]."\n";
	echo "contact_email ".$row["contact_email"]."\n";
	echo "job_desc ".$row["job_desc"]."\n";
	echo "pay ".$row["pay"]."\n";
	echo "weekly_hours_required".$row["weekly_hours_required"]."\n";
	echo"Requirements";
	echo "semester ".$row["semester"]."\n";
	
	echo "min_gpa_required ".$row["min_gpa_required"]."\n";
	echo "start_date ".$row["start_date"]."\n";
	echo "end_date ".$row["end_date"]."\n";


	$stmt = $db->prepare("SELECT placement_id FROM placements WHERE internship_id=:internship_id AND student_id =:student_id
		");
	$stmt->execute(array(':internship_id' => $internship_id,
						':student_id' => $student_id));
	$placed = $stmt->fetch();

	
}
if(isset($_POST["submit"]))
{
	$sql = "INSERT INTO placements (student_id,internship_id,internship_placed,internship_complete) VALUES (:student_id,:internship_id,:internship_placed,:internship_complete)";
	$q = $db->prepare($sql);
	$q->execute(array(':student_id'=>$student_id,
                 	 ':internship_id'=>$internship_id,
                 	 ':internship_placed'=>"N",
                 	 ':internship_complete'=>"N"
                 	 ));
header('Location: internships.php');
echo"SUBMITTED";
}

echo "<a href='logout.php'>Logout</a>";
if(empty($placed))
{
?>
<form id="apply" method="post" action="detail.php?id=<?php echo $internship_id ;?>">

<input type=submit name="submit" value="submit">
</form>

<p id="demo"></p>

<?php 
}
else
{
	echo "Already applied";
}
 ?>
</body>
</html>