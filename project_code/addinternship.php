<?php 
include('connect.php'); 
$page = "all";
include('session.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Add Internship | Internship Tracking System</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- date picker -->
    
    <!-- color picker -->
    
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

	<style type="text/css">
	#internshipmenuadd a {
	  font-weight: bold;
	  color: #fff;
	}
	</style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->

  </head>
  <body>
<?php
	//$stmt = $db->prepare("SELECT * FROM person WHERE person_id=?");
	$prsndetails = $_SESSION['username']['qry'];
	$person_id=$result['person_id'];
	
	if(isset($_POST["addinternship"]))
	{
		/*---------------------------internship form submit--------------------------*/		
    $business_id = $_POST['business_id'];
		$jobTitle = $_POST['job_title'];
		$jobDesc = $_POST['job_desc'];
		$semester= $_POST['semester'];
		$weeklyHoursRequired = $_POST['weekly_hours_required'];
		$minGpaRequired = $_POST['min_gpa_required'];
		$startDate = $_POST['start_date'];
		$endDate = $_POST['end_date'];
		$internshipActive = $_POST['internship_active'];
		$pay = $_POST['pay'];
	   

		$sql = "INSERT INTO internship ( business_id,job_title, job_desc, semester, weekly_hours_required, min_gpa_required, start_date, end_date, internship_active, pay) VALUES (:business_id,:job_title, :job_desc, :semester, :weekly_hours_required, :min_gpa_required, :start_date, :end_date, :internship_active, :pay)";
		$q = $db->prepare($sql);
		
		

		$q->execute(array(
            ':business_id'=>$business_id,
						 ':job_title'=>$jobTitle,
						 ':job_desc'=>$jobDesc,
						 ':semester'=>$semester,
						 ':weekly_hours_required'=>$weeklyHoursRequired,
						 ':min_gpa_required'=>$minGpaRequired,
						 ':start_date'=>$startDate,
						 ':end_date'=>$endDate,
						 ':internship_active'=>$internshipActive,
						 ':pay'=>$pay
						 ));
		header('Location: listinternships.php');
		
	}
?>
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
					<h3 class="page-header"><i class="fa fa-file-text-o"></i> Add Internship</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-table"></i>Internship</li>
						<li><i class="fa fa-play"></i>Add Internship</li>
					</ol>
				</div>
			</div>
<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Add New Internship
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="" novalidate="novalidate">
                                      <div class="form-group ">
                                          <label for="business" class="control-label col-lg-2">Business <span class="required">*</span></label>
                                          <div class="col-lg-10">
											<select  name="business_id" class="form-control m-bot15" required="">
											  <?php
												/*-------------------------------Business Listing--------------------------------*/
												$stmt = $db->prepare("SELECT * FROM business");
												$stmt->execute();
												echo "<option value=''> --Select--</option>";

												while($row = $stmt->fetch())
												{
												?>
												<option value="<?php echo $row['business_id']?>"><?php echo $row['business_name']?></option>
											  <?php
												}
												?>
											</select>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="title" class="control-label col-lg-2">Job Title <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="title" name="job_title" minlength="5" type="text" required="">
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="desc" class="control-label col-lg-2">Job Description </label>
											<!-- CKEditor -->
										  <div class="col-lg-10">
											  <section class="panel">
												  <div class="panel-body">
													  <div class="form">
															  <div class="form-group">
																  <div class="col-sm-10">
																	  <textarea id="desc" class="form-control ckeditor" name="job_desc" rows="6"></textarea>
																  </div>
															  </div>
													  </div>
												  </div>
											  </section>
										  </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="sem" class="control-label col-lg-2">Semester <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="sem" name="semester" type="text" required="">
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="whr" class="control-label col-lg-2">Weekly Hours Required <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="whr" name="weekly_hours_required" type="text" required="">
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="whr" class="control-label col-lg-2">Minimum GPA required <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="whr" name="min_gpa_required" type="text" required="">
                                          </div>
                                      </div>
                                      <div class="form-group radios">
                                          <label for="istatus" class="control-label col-lg-2">Internship Status <span class="required">*</span></label>
										<div class="col-lg-10">
                                              <label class="label_radio r_on" for="radio-01">
                                                  <input name="internship_active" id="radio-01" value="1" type="radio" checked=""> Active
                                              </label>
                                              <label class="label_radio r_off" for="radio-02">
                                                  <input name="internship_active" id="radio-02" value="0" type="radio"> Not Active
                                              </label>
                                        </div>
									  </div>
                                      <div class="form-group ">
                                          <label for="sdate" class="control-label col-lg-2">Start Date<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="sdate" name="start_date" type="date" required="">
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="edate" class="control-label col-lg-2">End Date<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="edate" name="end_date" type="date" required="">
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="pay" class="control-label col-lg-2">Pay<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="pay" name="pay" type="text" required="">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" name="addinternship" type="submit">Save</button>
                                              <button class="btn btn-default" type="button" type="reset">Cancel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>

                          </div>
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
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

    <!-- jquery ui -->
    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>

    <!--custom checkbox & radio-->
    <script type="text/javascript" src="js/ga.js"></script>
    <!--custom switch-->
    <script src="js/bootstrap-switch.js"></script>
    <!--custom tagsinput-->
    <script src="js/jquery.tagsinput.js"></script>
    
    <!-- colorpicker -->
   
    <!-- bootstrap-wysiwyg -->
    <script src="js/jquery.hotkeys.js"></script>
    <script src="js/bootstrap-wysiwyg.js"></script>
    <script src="js/bootstrap-wysiwyg-custom.js"></script>
    <!-- ck editor -->
    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    <!-- custom form component script for this page-->
    <script src="js/form-component.js"></script>
    <!-- jquery validate js -->
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>

    <!-- custom form validation script for this page-->
    <script src="js/form-validation-script.js"></script>
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>    
	<script>
		  $("#internshipsmenu").addClass("active");
		  $("#internshipmenuadd").addClass("active2");
	</script>
  </body>
</html>
