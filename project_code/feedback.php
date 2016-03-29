<?php 
include('connect.php'); 
$page = "all";
include('session.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Evaluate</title>

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
	#supervisormenuadd a {
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
	
	if(isset($_POST["addcomments"]))
	{
		$comments = $_POST['comments'];
		$technical_skills=$_POST['technical_skills'];
		
		$placementid =$_GET['pid'];
		$sql = "INSERT INTO evaluation (placement_id,comments) VALUES ( :placementid,:comments)";
		$q = $db->prepare($sql);
		
		$q->execute(array(':placementid'=>$placementid,
						 ':comments'=>$comments
						 ));
	   
		$evaluation_id = $db->lastInsertId(); 
		
		$sql = "INSERT INTO supervisor_evaluation (evaluation_id,technical_skills) VALUES (:evaluation_id, :technical_skills )";
		$q = $db->prepare($sql);
		$q->execute(array(':evaluation_id'=>$evaluation_id,
						 ':technical_skills'=>$technical_skills
						));
		header('Location:studentappliedinternship.php?evaluationform=1');
		
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
					<h3 class="page-header"><i class="fa fa-file-text-o"></i> Submit Evaluation Form</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-table"></i>Internship</li>
						<li><i class="fa fa-play"></i>Evaluate</li>
					</ol>
				</div>
			</div>
<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Add feedback
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="" novalidate="novalidate">
                                      
                                      <div class="form-group ">
                                          <label for="technical_skills" class="control-label col-lg-2">Technical skills <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="technical_skills" name="technical_skills"  type="text" required="">
                                          </div>
                                      </div>
       

										<div class="form-group ">
                                          <label for="comments" class="control-label col-lg-2">Comments <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="comments" name="comments" minlength="5" type="text" required="">
                                          </div>
                                      </div>
                                    
									  <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" id="addcomments" name="addcomments" value="addcomments" type="submit">Submit</button>
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
		  $("#supervisormenu").addClass("active");
		  $("#supervisormenuadd").addClass("active2");
	</script>
  </body>
</html>
