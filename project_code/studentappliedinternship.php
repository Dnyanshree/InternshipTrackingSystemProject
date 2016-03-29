<?php 
include('connect.php'); 
  $page = "all";
  include('session.php');
  $prsndetails = $_SESSION['username']['qry'];
  $person_id=$result['person_id'];
$update[0]=0;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Applied Internships | Internship Tracking System</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
	<style type="text/css">
	.form-group{float:left}
	</style>
	<script>
	function funcdelete(id,name){
	var del=confirm("Are you sure want to delete "+name+" ??");
	if(del==true)
	{
		window.location="func/deleteinternship.php?id="+id;
		return false;
	}
	}
	</script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
  </head>
<?php
 
	
  $stmt = $db->prepare("SELECT student_id FROM student  WHERE person_id= :person_id");
    $stmt->execute(array(':person_id' => $person_id
      ));
      
    $row = $stmt->fetch();
   
    if(!empty($row['student_id']))
    {
        $student_id = $row['student_id'];
    }
    
?>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
      <?php include('header.php'); ?>      
      <!--header end-->

      <!--sidebar start-->
      <?php include('sidebar.php'); ?>
      <!--sidebar end-->
	  
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-table"></i> Applied Internships</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-table"></i>Internships</li>
						<li><i class="fa fa-th-list"></i>Applied Internships</li>
					</ol>
				</div>
			</div>
              <!-- page start-->
            <div class="row">
			<?php
				if(isset($_GET['evaluationform'])) {
					$mat=$_GET['evaluationform'];
					echo "<div class='col-lg-12'>";
					if($mat==1)
						echo "<h4 style=\"color:blue; \">Evaluation Form Submitted</h4>";
					echo "</div>";
					
				}
			?>

			</div>
			<div class="row">
				<div class="col-lg-12">
                  <div class="col-lg-12">
                      <section class="panel">                          
                          <header class="panel-heading">
                              Applied Internships
                          </header>
                          
						  <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th>Title</th>
                                 <th>Description</th>
                                 <th>Semester</th>
                                 <th>Weekly hours</th>
								 <th>Min GPA required</th>
								 <th>Pay</th>
								 <th>Start date</th>
                                 <th>End date</th>
								 <th>Status</th>
								 <th>Feedback</th>
                                 
                              </tr>
							  <?php
								/*-------------------------------Applied Internship Listing--------------------------------*/
								$stmt = $db->prepare("SELECT * FROM internship as I, placements as P WHERE P.internship_id=I.internship_id AND P.student_id = :student_id AND I.internship_active=1  order by internship_placed,end_date DESC");
								$stmt->execute(array(':student_id' => $student_id));
								$result = $stmt->fetchAll();
								foreach ($result as $row)
								{
								?>
                              <tr>
                                 <td><?=$row['job_title']?></td>
                                 <td><?=$row['job_desc']?></td>
                                 <td><?=$row['semester']?></td>
								 <td><?=$row['weekly_hours_required']?></td>
                                 <td><?=$row['min_gpa_required']?></td>
                                 <td><?=$row['pay']?></td>
								 <td><?=$row['start_date']?></td>
								 <td><?=$row['end_date']?></td>
								 <td><?=$row['internship_placed']=='Y' ? 'Placed':'Pending' ?></td>
								 <?php
								 
								 if($row['internship_complete']=='Y')
								 {
								 $stud_eval = $db->prepare('SELECT * from evaluation as E,supervisor_evaluation as SV where E.placement_id=? AND E.evaluation_id=SV.evaluation_id');
								 $stud_eval->execute(array($row['placement_id']));
								 $evalST = $stud_eval->rowCount();
								 if($evalST!=1)
									 echo "<td><a href=\"feedback.php?pid=".$row['placement_id']."\"> <u>Evaluate</u></a></td>";
								 else
									echo "<td style='color:blue'> Submitted </td>";
								 
								 }								 
								 else
								 {
								 ?>
                                 <td> -- </td>
								 <?php 
								 }
								 ?>
								 <?php } ?>	 
								 
                              </tr>                              
							  <?php
							  
							  ?>
                           </tbody>
                        </table>
						                      </section>
                  </div>
              </div>
				</div>
			</div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section end -->
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nicescroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
	<script>
		  $("#appliedinternshipsmenu").addClass("active");
		  $("#appliedinternshipsmenu").addClass("active2");
		  
	</script>
  </body>
</html>
