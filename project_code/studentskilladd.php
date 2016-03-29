<?php 
include('connect.php'); 
$page = "all";
include('session.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Add Student Skill | Internship Tracking System</title>

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
	#studskillsmenuadd a {
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
  $q = $db->query("SELECT student_id FROM student WHERE person_id='".$person_id."'");
  $f = $q->fetch();
  $student_id = $f['student_id'];	
	
	if(isset($_POST["addstudentskill"]))
	{
    
		/*---------------------------internship form submit--------------------------*/		
		
		$skillId = $_POST['skill'];
    $skillLevel = $_POST['skill_level'];
	   

		$sql = "INSERT INTO student_skill ( student_id, skill_id, skill_level) VALUES (:student_id, :skill_id, :skill_level)";
		$q = $db->prepare($sql);
		

		$q->execute(array(
             ':student_id'=>$student_id,
						 ':skill_id'=>$skillId,
             ':skill_level' =>$skillLevel								
						 ));
		header('Location: studentskilllist.php');
		
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
					<h3 class="page-header"><i class="fa fa-file-text-o"></i> Add Student Skill</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-table"></i>Student Skill</li>
						<li><i class="fa fa-play"></i>Add Student Skill</li>
					</ol>
				</div>
			</div>
<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Add New Student Skill
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="" novalidate="novalidate">
                                      <div class="form-group ">
                                          <label for="skill" class="control-label col-lg-2">Skill<span class="required">*</span></label>
                                          <div class="col-lg-10">
                      											<select name="skill" class="form-control m-bot15" required="">
                      											  <?php
                      												/*-------------------------------Business Listing--------------------------------*/
                      												$stmt = $db->prepare("SELECT * FROM skill");
                      												$stmt->execute();
                      												echo "<option value=''> --Select--</option>";

                      												while($row = $stmt->fetch())
                      												{
                      												?>
                      												<option value="<?=$row['skill_id']?>"><?=$row['skill_name']?></option>
                      											  <?php
                      												}
                      												?>
                      											</select>
                                          </div>
                                                <label for="skill_level"   class="control-label col-lg-2">Skill Level<span class="required">*</span></label>
                                          <div class="col-lg-10">
                                                <select name="skill_level"  class="form-control m-bot15" required="">
                                                  <?php
                                                  /*-------------------------------Business Listing--------------------------------*/
                                                
                                                  echo "<option value=''> --Select--</option>";
                                                 
                                                  ?>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                                  <option value="6">6</option>
                                                  <option value="7">7</option>
                                                  <option value="8>">8</option>
                                                  <option value="9">9</option>
                                                  <option value="10">10</option>
                                                  <?php
                                                  
                                                  ?>
                                                </select>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" name="addstudentskill" type="submit">Save</button>
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
		  $("#studskillsmenu").addClass("active");
		  $("#studskillsmenuadd").addClass("active2");
	</script>
  </body>
</html>
