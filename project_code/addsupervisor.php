<?php 
include('connect.php'); 
$page = "all";
include('session.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Add Supervisor | Internship Tracking System</title>

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
	
	if(isset($_POST["addsupervisor"]))
	{
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

		$sql = "INSERT INTO person (person_type,first_name, middle_name, last_name, phone, email, address_line_1, address_line_2, city, state,country,zip_code) VALUES ( :person_type,:first_name, :middle_name, :last_name, :phone, :email, :address_line_1, :address_line_2, :city, :state,:country, :zip_code)";
		$q = $db->prepare($sql);
		print_r( $q);
		$q->execute(array(':person_type'=>"supervisor",
						 ':first_name'=>$first_name,
						 ':middle_name'=>$middle_name,
						 ':last_name'=>$last_name,
						 ':phone'=>$phone,
						 ':email'=>$email,
						 ':address_line_1'=>$address_line_1,
						 ':address_line_2'=>$address_line_2,
						 ':city'=>$city,
						 ':state'=>$state,
						 ':country'=>$country,
						 ':zip_code'=>$zip_code,
						 ));
	   
		$person_id = $db->lastInsertId(); 

		$sql = "INSERT INTO supervisor (person_id,business_id) VALUES (:person_id, :business_id )";
		$q = $db->prepare($sql);
		$q->execute(array(':person_id'=>$person_id,
						 ':business_id'=>$_GET["id"]
						));
		
		$sql = "INSERT INTO login (person_id) VALUES (:person_id )";
		$q = $db->prepare($sql);    
		$q->execute(array(':person_id'=>$person_id
						));
		
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
					<h3 class="page-header"><i class="fa fa-file-text-o"></i> Add Supervisor</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-table"></i>Supervisor</li>
						<li><i class="fa fa-play"></i>Add Supervisor</li>
					</ol>
				</div>
			</div>
<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Add New Supervisor
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="" novalidate="novalidate">
                                      
                                      <div class="form-group ">
                                          <label for="first_name" class="control-label col-lg-2">First Name <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="first_name" name="first_name" minlength="5" type="text" required="">
                                          </div>
                                      </div>
                                     
                                      <div class="form-group ">
                                          <label for="middle_name" class="control-label col-lg-2">Middle Name <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="middle_name" name="middle_name" type="text" required="">
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="last_name" class="control-label col-lg-2">Last Name <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="last_name" name="last_name" type="text" required="">
                                          </div>
                                      </div>
									  <div class="form-group ">
                                          <label for="phone" class="control-label col-lg-2">Phone <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="phone" name="phone" type="number" required="">
                                          </div>
                                      </div>
									  <div class="form-group ">
                                          <label for="email" class="control-label col-lg-2">Email <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="email" name="email" type="email" required="">
                                          </div>
                                      </div>
									  <div class="form-group ">
                                          <label for="address_line_1" class="control-label col-lg-2">Address line 1 <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="address_line_1" name="address_line_1" type="text" required="">
                                          </div>
                                      </div>
									  
									  <div class="form-group ">
                                          <label for="address_line_2" class="control-label col-lg-2">Address line 2 <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="address_line_2" name="address_line_2" type="text" required="">
                                          </div>
                                      </div>
									  
									  <div class="form-group ">
                                          <label for="city" class="control-label col-lg-2">City <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="city" name="city" type="text" required="">
                                          </div>
                                      </div>
									  
									  <div class="form-group ">
                                          <label for="state" class="control-label col-lg-2">State <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="state" name="state" type="text" required="">
                                          </div>
                                      </div>
									  
									  <div class="form-group ">
                                          <label for="country" class="control-label col-lg-2">Country <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="country" name="country" type="text" required="">
                                          </div>
                                      </div>
									  
									  <div class="form-group ">
                                          <label for="zip_code" class="control-label col-lg-2">Zip Code <span class="required">*</span></label>
                                          <div class="col-lg-10">
                                              <input class="form-control" id="zip_code" name="zip_code" type="number" required="">
                                          </div>
                                      </div>
									  <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" id="addsupervisor" name="addsupervisor" value="addsupervisor" type="submit">Save</button>
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
