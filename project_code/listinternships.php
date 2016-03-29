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

    <title>List Internships | Internship Tracking System</title>

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
	#internshipmenulist a {
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

	if(isset($_POST["updateform"]))
	{
		
		
		$internshipid=$_POST['internshipid'];
		$jobTitle = $_POST['job_title'];
		$jobDesc = $_POST['job_desc'];
		$semester= $_POST['semester'];
		$weeklyHoursRequired = $_POST['weekly_hours_required'];
		$minGpaRequired = $_POST['min_gpa_required'];
		$startDate = $_POST['start_date'];
		$endDate = $_POST['end_date'];
		
		$pay = $_POST['pay'];

		
            
	mysqli_query($link,"CALL sp_Update_Internship('$internshipid','$jobTitle','$jobDesc','$semester','$weeklyHoursRequired','$minGpaRequired','$startDate','$endDate','$pay')");

		$update[0]=1;
		$update[1]=ucwords($jobTitle." ".$jobTitle);

	   
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
					<h3 class="page-header"><i class="fa fa-table"></i> List Internships</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-table"></i>Internships</li>
						<li><i class="fa fa-th-list"></i>List Internships</li>
					</ol>
				</div>
			</div>
              <!-- page start-->
              <div class="row">
				<?php
				if(isset($_GET['delete'])) {
					$mat=$_GET['delete'];
					if($mat=='success')
					echo "<div class='col-lg-12'>";
					echo "<h4 style=\"color:red; \">Internship Deleted Successfully</h4>";
					echo "</div>";
				}
				if($update[0]==1) {
					echo "<div class='col-lg-12'>";
					echo "<h4 style=\"color:green; \">Internship ".$update[1]." Updated Successfully</h4>";
					echo "</div>";
				}
				?>
                  <div class="col-lg-12">
                      <section class="panel">                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_calendar"></i>Business Name</th>
                                 <th><i class="icon_calendar"></i> Job Title</th>
                                 <th><i class="icon_calendar"></i> Job Desc</th>
                                 <th><i class="icon_calendar"></i> Semester</th>
                                 <th><i class="icon_calendar"></i> Weekly Hours</th>
                                 <th><i class="icon_calendar"></i> Minimum Gpa</th>
                                 <th><i class="icon_calendar"></i> Start Date</th>
                                 <th><i class="icon_calendar"></i> End Date</th>
                                 <th><i class="icon_calendar"></i> Internship Status</th>
                                 <th><i class="icon_calendar"></i> Pay</th>
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
							  <?php
								/*-------------------------------Supervisor Listing--------------------------------*/
								$stmt = $db->prepare("SELECT * FROM internship as I left join business as B on B.business_id=I.business_id WHERE I.internship_active =1");
								$stmt->execute();
								while($row = $stmt->fetch())
								{
								?>
                              <tr>
                                 <td><?php echo $row['business_name']?></td>
                                 <td><?php echo $row['job_title']?></td>
                                 <td><?php echo $row['job_desc']?></td>
                                 <td><?php echo $row['semester']?></td>
                                 <td><?php echo$row['weekly_hours_required']?></td>
                                 <td><?php echo$row['min_gpa_required']?></td>
                                 <td><?php echo$row['start_date']?></td>
                                 <td><?php echo$row['end_date']?></td>
                                 <td>
								 <?php 
								 if($row['internship_active']==1)
									echo "Active";
								 else
									echo "Inactive";
								 ?>
								 </td>
                                 <td><?=$row['pay']?></td>
                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" href="#" onclick="return funcdelete('<?php echo $row['internship_id']?>','<?php echo strtoupper($row['job_title'])?>');"><i class="icon_check_alt2"></i> Remove</a>
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
                                                  <!-- <div class="form-group">
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
                                                  </div> -->
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
		  $("#internshipmenulist").addClass("active2");
		  
	</script>
  </body>
</html>
