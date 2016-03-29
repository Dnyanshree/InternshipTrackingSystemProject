<?php 
include('connect.php'); 
$page = "all";
include('session.php'); 
$update[0]=0;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Assign Internship | Internship Tracking System</title>

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
	#internshipmenuassign a {
	  font-weight: bold;
	  color: #fff;
	}
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
	function funcassign(id,name,val){
	if(val!="null"){
	var asg=confirm("Are you sure want to assign internship to "+name+" ??");
	if(asg==true)
	{
			window.location="func/assigninternshipajax.php?id="+id+"&val="+val;
			return false;
	}
	}	
	}
	function funcomplete(id,name,val){
	if(val!="null"){
	var asg=confirm("Are you sure want to complete internship of "+name+" ??");
	if(asg==true)
	{
			window.location="func/completeinternshipajax.php?id="+id+"&val="+val;
			return false;
	}
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
	//$stmt = $db->prepare("SELECT * FROM person WHERE person_id=?");
	$prsndetails = $_SESSION['username']['qry'];
	$person_id=$result['person_id'];

	if(isset($_POST["updateforms"]))
	{
		$person_id = $_POST['internshipid'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name= $_POST['last_name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$address_line_1 = $_POST['address_line_1'];
		$address_line_2 = $_POST['address_line_2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$zip_code = $_POST['zip_code'];
		

		$sql = "UPDATE person SET first_name=?, 
									middle_name=?, 
									last_name=?, 
									phone=?, 
									email=?, 
									address_line_1=?, 
									address_line_2=?, 
									city=?, 
									state=?, 
									country=?, 
									zip_code=? WHERE person_id=?";
		$q = $db->prepare($sql);
		$q->execute(array($first_name,
						 $middle_name,
						 $last_name,
						 $phone,
						 $email,
						 $address_line_1,
						 $address_line_2,
						 $city,
						 $state,
						 $country,
						 $zip_code,
						 $person_id
						 ));

		$update[0]=1;
		$update[1]=ucwords($last_name." ".$first_name);
	   
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
					<h3 class="page-header"><i class="fa fa-table"></i> Assign Internship</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-table"></i>Internships</li>
						<li><i class="fa fa-th-list"></i>Assign Internships</li>
					</ol>
				</div>
			</div>
              <!-- page start-->
              <div class="row">
				<?php
				if(isset($_GET['assign'])) {
					$mat=$_GET['assign'];
					echo "<div class='col-lg-12'>";
					if($mat==1)
						echo "<h4 style=\"color:blue; \">Internship Assigned Successfully</h4>";
					else
						echo "<h4 style=\"color:red; \">Internship Rejected Successfully</h4>";
					echo "</div>";
					
				}
				if(isset($_GET['complete'])) {
					$mat=$_GET['complete'];
					echo "<div class='col-lg-12'>";
					if($mat=="success")
						echo "<h4 style=\"color:blue; \">Internship Marked Complete Successfully</h4>";
					else
						echo "<h4 style=\"color:red; \">Internship Rejected Successfully</h4>";
					echo "</div>";
					
				}
				if($update[0]==1) {
					echo "<div class='col-lg-12'>";
					echo "<h4 style=\"color:green; \">Internship ".$update[1]." Updated Successfully</h4>";
					echo "</div>";
				}
				?>
				</div>
				
			<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_calendar"></i>Student Id</th>
                                 <th><i class="icon_calendar"></i> Student Name</th>
                                 <th><i class="icon_calendar"></i> Job Title</th>
                                 <th><i class="icon_calendar"></i> Business Name</th>
                                 <th><i class="icon_calendar"></i> Min GPA Req</th>
                                 <th><i class="icon_calendar"></i> Student GPA</th>
                                 <th><i class="icon_calendar"></i> Assign </th>
                                 <th><i class="icon_calendar"></i> Internship Status </th>
                                 <th><i class="icon_calendar"></i> Student Feedback </th>
                                 <th><i class="icon_calendar"></i> Supervisor Feedback </th>
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
							  <?php
								/*-------------------------------Supervisor Listing--------------------------------*/
								$stmt = $db->prepare("SELECT * FROM internship as I, placements as P, student as S, person as Ps WHERE P.internship_id=I.internship_id AND Ps.person_id=S.person_id AND S.student_id=P.student_id ORDER BY `P`.`internship_placed` DESC");
								$stmt->execute();
								while($row = $stmt->fetch())
								{
								?>
                              <tr>
                                 <td><?=ucwords($row['student_id'])?></td>
                                 <td><?=ucwords($row['last_name']." ".$row['first_name'])?></td>
                                 <td><?=ucwords($row['job_title'])?></td>
                                 <td>
								 <?php 
								 $newqry = $db->prepare('SELECT business_name,contact_name,contact_email from business where business_id=?');
								 $newqry->execute(array($row['business_id']));
								 $business = $newqry->fetch();
								 echo $business['business_name'];
								 ?>
								 </td>
                                 <td><?=ucwords($row['min_gpa_required'])?></td>
                                 <td><?=ucwords($row['gpa'])?></td>
								 <td>
								 <?php if($row['internship_placed']=='N')
								 {
								 ?>
                                 
								 <select onchange="return funcassign('<?=$row['placement_id']?>','<?=ucwords($row['last_name'].' '.$row['first_name'])?>',this.value)">
									<option value="null"> --Select-- </option>
									<option value="1"> Assign</option>
									<option value="0"> Reject </option>
								 </select>
								 
								 <?php
								 }
								 else if($row['internship_placed']=='R')
									echo "<span style='color:red'>REJECTED</span>";
								 else
									echo "<span style='color:green'>ASSIGNED</span>";
								 ?>
								 </td>
								 <td><center>
								 <?php
								 if($row['internship_placed']=='R')
									echo "--";
								 else if($row['internship_placed']=='Y')
									if($row['internship_complete']=='Y')
										echo "Internship Completed";
									else
									{
										echo "Running<br/>";
								 ?>
								 <input type="button" class="btn btn-primary  btn-sm" value="Mark Complete" onclick="return funcomplete('<?=$row['placement_id']?>','<?=ucwords($row['last_name'].' '.$row['first_name'])?>',this.value)">
								 <?php
								 }
								 ?>
								 </center>
								 </td>
								 <?php
								 if($row['internship_complete']=='Y')
								 {
								 $stud_eval = $db->prepare('SELECT * from evaluation as E,supervisor_evaluation as SV where E.placement_id=? AND E.evaluation_id=SV.evaluation_id');
								 $stud_eval->execute(array($row['placement_id']));
								 $evalST = $stud_eval->rowCount();
								 $studD = $stud_eval->fetch();
								 if($evalST!=1)
									echo "<td style='color:red'> Not Submitted </td>";
								 else
									echo "<td style='color:blue'> Technical Skills: <b><u>".$studD['technical_skills']."</u></b> </td>"; 
								 								 
                                 $sup_eval = $db->prepare('SELECT * from evaluation as E,student_evaluation as ST where E.placement_id=? AND E.evaluation_id=ST.evaluation_id');
								 $sup_eval->execute(array($row['placement_id']));
								 $evalSV = $sup_eval->rowCount();
								 $supD = $sup_eval->fetch();
								 if($evalSV!=1)
									echo "<td style='color:red'> Not Submitted </td>";
								 else
									echo "<td style='color:blue'> Performance: <b><u>".$supD['performance']."</u></b><br/> Punctuality: <b><u>".$supD['punctuality']."</u></b> </td>"; 
								 }								 
								 else
								 {
								 ?>
                                 <td> -- </td>
                                 <td> -- </td>
								 <?php 
								 }
								 ?>
								 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-danger"  href="#myModal-<?php echo $row['internship_id']?>" data-toggle="modal" ><i class="icon_check_alt2"></i> Edit</a>
                                  </div>
								  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-<?php echo $row['internship_id']?>" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content" style = "float:left;width:95%">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Edit Internship</h4>
                                          </div>
                                          <div class="modal-body">
                                              <form role="form" name="updateform" method="post" action="">
                                                  <div class="form-group">
                                                      <label class="col-lg-2" for="job_title">Job Title: </label>
													  <div class=" col-lg-10">
														<input class="form-control" value="<?=$row['job_title']?>" id="job_title" type="text" name="job_title" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="job_desc">Job Desc: </label>
													  <div class=" col-lg-9">
														<textarea class="form-control" id="job_desc" type="text" name="job_desc">
															<?=$row['job_desc']?>
														</textarea>
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="semester">Semester: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['semester']?>" id="semester" type="text" name="semester" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="weekly_hours_required">Weekly Hours: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['weekly_hours_required']?>" id="weekly_hours_required" type="text" name="weekly_hours_required" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="min_gpa_required">Min Gpa: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['min_gpa_required']?>" id="min_gpa_required" type="text" name="min_gpa_required" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="start_date">Start Date: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['start_date']?>" id="start_date" type="text" name="start_date" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="end_date">End Date: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['end_date']?>" id="end_date" type="text" name="end_date" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="internship_active">Internship Status: </label>
													  <div class=" col-lg-9">
													  <?php if($row['internship_active']==1){?>
														<input class="form-control" value="<?=$row['internship_active']?>" id="internship_active" type="radio" name="internship_active" selected />Active
														<input class="form-control" value="<?=$row['internship_active']?>" id="internship_active" type="radio" name="internship_active" />Inactive
													  <?php }else{?>
														<input class="form-control" value="<?=$row['internship_active']?>" id="internship_active" type="radio" name="internship_active"  />Active
														<input class="form-control" value="<?=$row['internship_active']?>" id="internship_active" type="radio" name="internship_active" selected />Inactive
													  <?php }?>
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="pay">Pay: </label>
													  <div class=" col-lg-9">
														<input class="form-control" value="<?=$row['pay']?>" id="pay" type="text" name="pay" required />
													  </div>
                                                  </div>
													<input type="hidden" name="internshipid" value="<?php echo $row['internship_id']?>" />
												  <div class="form-group">
													<button type="submit" class="btn btn-primary" name="updateform">Submit</button>
												</div>
											  </form>
                                          </div>
                                      </div>
                                  </div>
                                </td>
                              </tr>                              
							  <?php
							  }
							  ?>
                           </tbody>
                        </table>
                      </section>
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
		  $("#internshipsmenu").addClass("active");
		  $("#internshipmenuassign").addClass("active2");
		  
	</script>
  </body>
</html>
