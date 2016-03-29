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
	
	if(isset($_POST["addinternship"]))
	{
		/*---------------------------internship form submit--------------------------*/		
		$jobTitle = $_POST['job_title'];
		$jobDesc = $_POST['job_desc'];
		$semester= $_POST['semester'];
		$weeklyHoursRequired = $_POST['weekly_hours_required'];
		$minGpaRequired = $_POST['min_gpa_required'];
		$startDate = $_POST['start_date'];
		$endDate = $_POST['end_date'];
		$internshipActive = $_POST['internship_active'];
		$pay = $_POST['pay'];
	   

		$sql = "INSERT INTO internship ( job_title, job_desc, semester, weekly_hours_required, min_gpa_required, start_date, end_date, internship_active, pay) VALUES (:job_title, :job_desc, :semester, :weekly_hours_required, :min_gpa_required, :start_date, :end_date, :internship_active, :pay)";
		$q = $db->prepare($sql);
		
		

		$q->execute(array(
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
		header('Location: adminLanding.php');
		
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
					<h3 class="page-header"><i class="fa fa-file-text-o"></i> Form elements</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
						<li><i class="icon_document_alt"></i>Forms</li>
						<li><i class="fa fa-file-text-o"></i>Form elements</li>
					</ol>
				</div>
			</div>
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Form Elements
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal " method="get">
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Default</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Help text</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control">
                                          <span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Rounder</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control round-input">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Input focus</label>
                                      <div class="col-sm-10">
                                          <input class="form-control" id="focusedInput" type="text" value="This is focused...">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Disabled</label>
                                      <div class="col-sm-10">
                                          <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input here..." disabled>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Placeholder</label>
                                      <div class="col-sm-10">
                                          <input type="text"  class="form-control" placeholder="placeholder">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Password</label>
                                      <div class="col-sm-10">
                                          <input type="password"  class="form-control" placeholder="">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Static control</label>
                                      <div class="col-lg-10">
                                          <p class="form-control-static">email@example.com</p>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section class="panel">
                          <div class="panel-body">
                              <form class="form-horizontal " method="get">
                                  <div class="form-group has-success">
                                      <label class="control-label col-lg-2" for="inputSuccess">Input with success</label>
                                      <div class="col-lg-10">
                                          <input type="text" class="form-control" id="inputSuccess">
                                      </div>
                                  </div>
                                  <div class="form-group has-warning">
                                      <label class="control-label col-lg-2" for="inputWarning">Input with warning</label>
                                      <div class="col-lg-10">
                                          <input type="text" class="form-control" id="inputWarning">
                                      </div>
                                  </div>
                                  <div class="form-group has-error">
                                      <label class="control-label col-lg-2" for="inputError">Input with error</label>
                                      <div class="col-lg-10">
                                          <input type="text" class="form-control" id="inputError">
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section class="panel">
                          <div class="panel-body">
                              <form class="form-horizontal " method="get">
                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Control sizing</label>
                                      <div class="col-lg-10">
                                          <input class="form-control input-lg m-bot15" type="text" placeholder=".input-lg">
                                          <input class="form-control m-bot15" type="text" placeholder="Default input">
                                          <input class="form-control input-sm m-bot15" type="text" placeholder=".input-sm">

                                          <select class="form-control input-lg m-bot15">
                                              <option>Option 1</option>
                                              <option>Option 2</option>
                                              <option>Option 3</option>
                                          </select>
                                          <select class="form-control m-bot15">
                                              <option>Option 1</option>
                                              <option>Option 2</option>
                                              <option>Option 3</option>
                                          </select>
                                          <select class="form-control input-sm m-bot15">
                                              <option>Option 1</option>
                                              <option>Option 2</option>
                                              <option>Option 3</option>
                                          </select>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section class="panel">
                          <div class="panel-body">
                              <form class="form-horizontal " method="get">
                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Checkboxes and radios</label>
                                      <div class="col-lg-10">
                                          <div class="checkbox">
                                              <label>
                                                  <input type="checkbox" value="">
                                                  Option one is this and that&mdash;be sure to include why it's great
                                              </label>
                                          </div>

                                          <div class="checkbox">
                                              <label>
                                                  <input type="checkbox" value="">
                                                  Option one is this and that&mdash;be sure to include why it's great option one
                                              </label>
                                          </div>

                                          <div class="radio">
                                              <label>
                                                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                                  Option one is this and that&mdash;be sure to include why it's great
                                              </label>
                                          </div>
                                          <div class="radio">
                                              <label>
                                                  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                  Option two can be something else and selecting it will deselect option one
                                              </label>
                                          </div>

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Inline checkboxes</label>
                                      <div class="col-lg-10">
                                          <label class="checkbox-inline">
                                              <input type="checkbox" id="inlineCheckbox1" value="option1"> 1
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox" id="inlineCheckbox2" value="option2"> 2
                                          </label>
                                          <label class="checkbox-inline">
                                              <input type="checkbox" id="inlineCheckbox3" value="option3"> 3
                                          </label>

                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Selects</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                          </select>

                                          <select multiple class="form-control">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="control-label col-lg-2" for="inputSuccess">Column sizing</label>
                                      <div class="col-lg-10">
                                          <div class="row">
                                              <div class="col-lg-2">
                                                  <input type="text" class="form-control" placeholder=".col-lg-2">
                                              </div>
                                              <div class="col-lg-3">
                                                  <input type="text" class="form-control" placeholder=".col-lg-3">
                                              </div>
                                              <div class="col-lg-4">
                                                  <input type="text" class="form-control" placeholder=".col-lg-4">
                                              </div>
                                          </div>

                                      </div>
                                  </div>

                              </form>
                          </div>
                      </section>
                  </div>
              </div>
              <!-- Basic Forms & Horizontal Forms-->
              
              <div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Basic Forms
                          </header>
                          <div class="panel-body">
                              <form role="form">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Email address</label>
                                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputPassword1">Password</label>
                                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputFile">File input</label>
                                      <input type="file" id="exampleInputFile">
                                      <p class="help-block">Example block-level help text here.</p>
                                  </div>
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox"> Check me out
                                      </label>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                              </form>

                          </div>
                      </section>
                  </div>
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Horizontal Forms
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-10">
                                          <input type="email" class="form-control" id="inputEmail1" placeholder="Email">
                                          <p class="help-block">Example block-level help text here.</p>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputPassword1" class="col-lg-2 control-label">Password</label>
                                      <div class="col-lg-10">
                                          <input type="password" class="form-control" id="inputPassword1" placeholder="Password">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <div class="checkbox">
                                              <label>
                                                  <input type="checkbox"> Remember me
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-danger">Sign in</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section class="panel">

                          <div class="panel-body">
                              <a href="#myModal" data-toggle="modal" class="btn btn-primary">
                                  Form in Modal
                              </a>
                              <a href="#myModal-1" data-toggle="modal" class="btn  btn-warning">
                                  Form in Modal 2
                              </a>
                              <a href="#myModal-2" data-toggle="modal" class="btn  btn-danger">
                                  Form in Modal 3
                              </a>

                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Form Tittle</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form">
                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1">Email address</label>
                                                      <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Enter email">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="exampleInputPassword1">Password</label>
                                                      <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Password">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="exampleInputFile">File input</label>
                                                      <input type="file" id="exampleInputFile3">
                                                      <p class="help-block">Example block-level help text here.</p>
                                                  </div>
                                                  <div class="checkbox">
                                                      <label>
                                                          <input type="checkbox"> Check me out
                                                      </label>
                                                  </div>
                                                  <button type="submit" class="btn btn-primary">Submit</button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Form Tittle</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form class="form-horizontal" role="form">
                                                  <div class="form-group">
                                                      <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
                                                      <div class="col-lg-10">
                                                          <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="inputPassword1" class="col-lg-2 control-label">Password</label>
                                                      <div class="col-lg-10">
                                                          <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                          <div class="checkbox">
                                                              <label>
                                                                  <input type="checkbox"> Remember me
                                                              </label>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <div class="col-lg-offset-2 col-lg-10">
                                                          <button type="submit" class="btn btn-info">Sign in</button>
                                                      </div>
                                                  </div>
                                              </form>

                                          </div>

                                      </div>
                                  </div>
                              </div>
                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-2" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Form Tittle</h4>
                                          </div>
                                          <div class="modal-body">
                                              <form class="form-inline" role="form">
                                                  <div class="form-group">
                                                      <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                      <input type="email" class="form-control sm-input" id="exampleInputEmail5" placeholder="Enter email">
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                      <input type="password" class="form-control sm-input" id="exampleInputPassword5" placeholder="Password">
                                                  </div>
                                                  <div class="checkbox">
                                                      <label>
                                                          <input type="checkbox"> Remember me
                                                      </label>
                                                  </div>
                                                  <button type="submit" class="btn btn-success">Sign in</button>
                                              </form>

                                          </div>

                                      </div>
                                  </div>
                              </div>
                          </div>
                      </section>
                  </div>
              </div>
              <!-- Inline form-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Inline form
                          </header>
                          <div class="panel-body">
                              <form class="form-inline" role="form">
                                  <div class="form-group">
                                      <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                      <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                                  </div>
                                  <div class="form-group">
                                      <label class="sr-only" for="exampleInputPassword2">Password</label>
                                      <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                                  </div>
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox"> Remember me
                                      </label>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Sign in</button>
                              </form>

                          </div>
                      </section>

                  </div>
              </div>

              <div class="row">
                  <div class="col-lg-12">                      

                      <div class="row">
                          <div class="col-lg-6">
                              <section class="panel">
                                  <header class="panel-heading">
                                      Color Pickers & Date Pickers
                                  </header>
                                  <div class="panel-body">
                                      <form class="form-horizontal " action="#">
                                          <!--date picker start-->

                                          <div class="form-group">
                                              <label class="control-label col-sm-4">Default Datepicker</label>
                                              <div class="col-sm-6">
                                                  <input id="cp1" type="text" value="28-10-2013" size="16" class="form-control">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="control-label col-sm-4">Starts with years view</label>
                                              <div class="col-sm-6">


                                                  <div class="input-append date" id="dpYears" data-date="18-06-2013"
                                                       data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                      <input class="form-control" size="16" type="text" value="28-06-2013" readonly>
                                                      <span class="add-on"><i class="icon-calendar"></i></span>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="form-group">
                                              <label class="control-label col-sm-4"> Date Ranges</label>
                                              <div class="col-sm-6">
                                                  <div class="input-prepend">
                                                      <input id="reservation" type="text" class=" form-control" />
                                                  </div>
                                              </div>
                                          </div>
                                          <!--date picker end-->

                                          <!--color picker start-->
                                          <div class="form-group">
                                              <label class="control-label col-sm-4">Default</label>

                                              <div class="col-sm-5">
                                                  <input type="text" value="#CCCCCC" class="cp1 form-control">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="control-label col-sm-4">RGBA</label>

                                              <div class="col-sm-5">
                                                  <input type="text" data-color-format="rgba" value="rgb(255,255,255,1)" class="cp2 form-control">
                                              </div>
                                          </div>

                                          <!--color picker end-->

                                      </form>


                                  </div>
                              </section>
                              <section class="panel">
                                  <header class="panel-heading">
                                      Tags Input
                                  </header>
                                  <div class="panel-body">
                                      <input name="tagsinput" id="tagsinput" class="tagsinput" value="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal" />
                                  </div>
                              </section>
                          </div>
                          <div class="col-lg-6">
                              <section class="panel">
                                  <header class="panel-heading">
                                      Custom Checkbox & Radio
                                  </header>
                                  <div class="panel-body">
                                      <form action="#" method="get" accept-charset="utf-8">
                                          <div class="checkboxes">
                                              <label class="label_check" for="checkbox-01">
                                                  <input name="sample-checkbox-01" id="checkbox-01" value="1" type="checkbox" checked /> I agree to the terms &#38; conditions.
                                              </label>
                                              <label class="label_check" for="checkbox-02">
                                              <input name="sample-checkbox-02" id="checkbox-02" value="1" type="checkbox" /> Please send me regular updates. </label>
                                              <label class="label_check" for="checkbox-03">
                                              <input name="sample-checkbox-02" id="checkbox-03" value="1" type="checkbox" /> This is nice checkbox.</label>

                                          </div>
                                          <div class="radios">
                                              <label class="label_radio" for="radio-01">
                                                  <input name="sample-radio" id="radio-01" value="1" type="radio" checked /> This is option A...
                                              </label>
                                              <label class="label_radio" for="radio-02">
                                                  <input name="sample-radio" id="radio-02" value="1" type="radio" /> and this is option B...
                                              </label>
                                              <label class="label_radio" for="radio-03">
                                                  <input name="sample-radio" id="radio-03" value="1" type="radio" /> or simply choose option C
                                              </label>
                                          </div>
                                      </form>
                                  </div>

                              </section>

                              <section class="panel">
                                  <header class="panel-heading">
                                      Switch
                                  </header>
                                  <div class="panel-body">
                                      <div class="row m-bot15">
                                          <div class="col-sm-6 text-center">
                                              <input type="checkbox" checked="" data-toggle="switch" />
                                          </div>
                                          <div class="col-sm-6 text-center">
                                              <input type="checkbox" data-toggle="switch" />
                                          </div>
                                      </div>
                                      <div class="row m-bot15">
                                          <div class="col-sm-6 text-center">
                                              <div class="switch switch-square"
                                                   data-on-label="<i class=' icon-ok'></i>"
                                                   data-off-label="<i class='icon-remove'></i>">
                                                  <input type="checkbox" />
                                              </div>
                                          </div>
                                          <div class="col-sm-6 text-center">
                                              <div class="switch switch-square"
                                                   data-on-label="<i class=' icon-ok'></i>"
                                                   data-off-label="<i class='icon-remove'></i>">
                                                  <input type="checkbox" checked="" />
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-6 text-center">
                                              <input type="checkbox" disabled data-toggle="switch" />
                                          </div>
                                          <div class="col-sm-6 text-center">
                                              <input type="checkbox" checked disabled data-toggle="switch" />
                                          </div>
                                      </div>
                                  </div>
                              </section>


                          </div>
                      </div>

                      <div class="row">
                        <!-- Bootsrep Editor -->
                        <div class="col-lg-12">
                            <section class="panel">
                                  <header class="panel-heading">
                                      Bootsrep Editor
                                  </header>
                                  <div class="panel-body">    
                                    <div id="editor" class="btn-toolbar" data-role="editor-toolbar" data-target="#editor"></div>
                                    </div>
                            </section>
                          </div>
                          <!-- CKEditor -->
                          <div class="col-lg-12">
                              <section class="panel">
                                  <header class="panel-heading">
                                      CKEditor
                                  </header>
                                  <div class="panel-body">
                                      <div class="form">
                                          <form action="#" class="form-horizontal">
                                              <div class="form-group">
                                                  <label class="control-label col-sm-2">CKEditor</label>
                                                  <div class="col-sm-10">
                                                      <textarea class="form-control ckeditor" name="editor1" rows="6"></textarea>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </section>
                          </div>
                      </div>
                  </div>
              </div>
<div class="row">
                  <div class="col-lg-6">
                      <!--notification start-->
                      <section class="panel">
                          <header class="panel-heading">
                            Alerts
                          </header>
                          <div class="panel-body">
                            <div class="alert alert-success fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <strong>Well done!</strong> You successfully read this important alert message.
                              </div>      
                              <div class="alert alert-block alert-danger fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <strong>Oh snap!</strong> Change a few things up and try submitting again.
                              </div>                              
                              <div class="alert alert-info fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                              </div>
                              <div class="alert alert-warning fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove"></i>
                                  </button>
                                  <strong>Warning!</strong> Best check yo self, you're not looking too good.
                              </div>

                          </div>
                      </section>
                      <!--notification end-->

                      <!--tab nav start-->
                      <section class="panel">
                          <header class="panel-heading tab-bg-primary ">
                              <ul class="nav nav-tabs">
                                  <li class="active">
                                      <a data-toggle="tab" href="#home">Home</a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#about">About</a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#profile">Profile</a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#contact">Contact</a>
                                  </li>
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div class="tab-content">
                                  <div id="home" class="tab-pane active">
                                      Home
                                  </div>
                                  <div id="about" class="tab-pane">About</div>
                                  <div id="profile" class="tab-pane">Profile</div>
                                  <div id="contact" class="tab-pane">Contact</div>
                              </div>
                          </div>
                      </section>
                      <!--tab nav start-->
                      <!--tab nav start-->
                      <section class="panel">
                          <header class="panel-heading tab-bg-primary">
                              <ul class="nav nav-tabs">
                                  <li>
                                      <a data-toggle="tab" href="#home-2">
                                          <i class="icon-home"></i>
                                      </a>
                                  </li>
                                  <li class="active">
                                      <a data-toggle="tab" href="#about-2">
                                          <i class="icon-user"></i>
                                          About
                                      </a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#contact-2">
                                          <i class="icon-envelope"></i>
                                          Contact
                                      </a>
                                  </li>
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div class="tab-content">
                                  <div id="home-2" class="tab-pane ">
                                      Home
                                  </div>
                                  <div id="about-2" class="tab-pane active">About</div>
                                  <div id="contact-2" class="tab-pane ">Contact</div>
                              </div>
                          </div>
                      </section>
                      <!--tab nav start-->

                      <!--tab nav start-->
                      <section class="panel">
                          <header class="panel-heading tab-bg-primary tab-right ">
                              <ul class="nav nav-tabs pull-right">
                                  <li class="active">
                                      <a data-toggle="tab" href="#home-3">
                                          <i class="icon-home"></i>
                                      </a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#about-3">
                                          <i class="icon-user"></i>
                                          About
                                      </a>
                                  </li>
                                  <li class="">
                                      <a data-toggle="tab" href="#contact-3">
                                          <i class="icon-envelope"></i>
                                          Contact
                                      </a>
                                  </li>
                              </ul>
                              <span class="hidden-sm wht-color">Right tab</span>
                          </header>
                          <div class="panel-body">
                              <div class="tab-content">
                                  <div id="home-3" class="tab-pane active">
                                      Home
                                  </div>
                                  <div id="about-3" class="tab-pane">About</div>
                                  <div id="contact-3" class="tab-pane">Contact</div>
                              </div>
                          </div>
                      </section>
                      <!--tab nav start-->
                      
                      <!--navigation start-->
                      <nav class="navbar navbar-default" role="navigation">
                          <!-- Brand and toggle get grouped for better mobile display -->
                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                              </button>
                              <a class="navbar-brand" href="#">Brand</a>
                          </div>

                          <!-- Collect the nav links, forms, and other content for toggling -->
                          <div class="collapse navbar-collapse navbar-ex1-collapse">
                              <ul class="nav navbar-nav">
                                  <li class="active"><a href="#">Link</a></li>
                                  <li><a href="javascript:;">Link</a></li>
                                  <li class="dropdown">
                                      <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                          <li><a href="#">Action</a></li>
                                          <li><a href="#">Another action</a></li>
                                          <li><a href="#">Something else here</a></li>
                                          <li><a href="#">Separated link</a></li>
                                          <li><a href="#">One more separated link</a></li>
                                      </ul>
                                  </li>
                              </ul>
                              <!--<form class="navbar-form navbar-left" role="search">-->
                              <!--<div class="form-group">-->
                              <!--<input type="text" class="form-control" placeholder="Search">-->
                              <!--</div>-->
                              <!--<button type="submit" class="btn btn-default">Submit</button>-->
                              <!--</form>-->
                              <ul class="nav navbar-nav navbar-right">
                                  <li><a href="javascript:;">Link</a></li>
                                  <li class="dropdown">
                                      <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                      <ul class="dropdown-menu">
                                          <li><a href="#">Action</a></li>
                                          <li><a href="#">Another action</a></li>
                                          <li><a href="#">Something else here</a></li>
                                          <li><a href="#">Separated link</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </div><!-- /.navbar-collapse -->
                      </nav>

                      <!--navigation end-->

                      <!--tooltips start-->
                      <section class="panel">
                          <div class="panel-body">
                              <button title="" data-placement="top" data-toggle="tooltip" class="btn btn-default tooltips" type="button" data-original-title="Tooltip on top">Tooltip on top</button>
                              <button title="" data-placement="left" data-toggle="tooltip" class="btn btn-default tooltips" type="button" data-original-title="Tooltip on left"> left</button>
                              <button title="" data-placement="bottom" data-toggle="tooltip " class="btn btn-default tooltips" type="button" data-original-title="Tooltip on bottom"> bottom</button>
                              <button title="" data-placement="right" data-toggle="tooltip" class="btn btn-default tooltips" type="button" data-original-title="Tooltip on right"> right</button>
                          </div>
                      </section>
                      <!--tooltips start-->

                      <!--popover start-->
                      <section class="panel">
                          <div class="panel-body">
                              <button data-original-title="Popovers in top" data-content="And here's some amazing content. It's very engaging. right?" data-placement="top" data-trigger="hover" class="btn btn-info popovers">Popover on Top</button>
                              <button data-original-title="Popovers in bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-placement="bottom" data-trigger="hover" class="btn btn-info popovers">Bottom</button>
                              <button data-original-title="Popovers in right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-placement="right" data-trigger="hover" class="btn btn-info popovers">Right</button>
                              <button data-original-title="Popovers in left" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-placement="left" data-trigger="hover" class="btn btn-info popovers">Left</button>
                          </div>
                      </section>
                      <!--popover start-->

                      <!--modal start-->
                      <section class="panel">
                          <header class="panel-heading">
                              Modal Dialogs
                          </header>
                          <div class="panel-body">
                              <a class="btn btn-success" data-toggle="modal" href="#myModal">
                                  Dialog
                              </a>
                              <a class="btn btn-warning" data-toggle="modal" href="#myModal2">
                                  Confirm
                              </a>
                              <a class="btn btn-danger" data-toggle="modal" href="#myModal3">
                                  Alert !
                              </a>
                              <!-- Modal -->
                              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                              <h4 class="modal-title">Modal Tittle</h4>
                                          </div>
                                          <div class="modal-body">

                                              Body goes here...

                                          </div>
                                          <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                              <button class="btn btn-success" type="button">Save changes</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                              <!-- Modal -->
                              <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                              <h4 class="modal-title">Modal Tittle</h4>
                                          </div>
                                          <div class="modal-body">

                                              Body goes here...

                                          </div>
                                          <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                              <button class="btn btn-warning" type="button"> Confirm</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->
                              <!-- Modal -->
                              <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                              <h4 class="modal-title">Modal Tittle</h4>
                                          </div>
                                          <div class="modal-body">

                                              Body goes here...

                                          </div>
                                          <div class="modal-footer">
                                              <button class="btn btn-danger" type="button"> Ok</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- modal -->

                          </div>
                      </section>
                      <!--modal start-->

                      <!--carousel start-->
                      <section class="panel">
                          <div id="c-slide" class="carousel slide auto panel-body">
                              <ol class="carousel-indicators out">
                                  <li class="active" data-slide-to="0" data-target="#c-slide"></li>
                                  <li class="" data-slide-to="1" data-target="#c-slide"></li>
                                  <li class="" data-slide-to="2" data-target="#c-slide"></li>
                              </ol>
                              <div class="carousel-inner">
                                  <div class="item text-center active">
                                      <h3>Creative is new model of Admin</h3>
                                      <small class="">Based on Bootstrap 3</small>
                                  </div>
                                  <div class="item text-center">
                                      <h3>Massive UI Elements</h3>
                                      <small class="">Fully Responsive</small>
                                  </div>
                                  <div class="item text-center">
                                      <h3>Well Documentation</h3>
                                      <small class="">Easy to Use</small>
                                  </div>
                              </div>
                              <a data-slide="prev" href="#c-slide" class="left carousel-control">
                                  <i class="arrow_carrot-left_alt2"></i>
                              </a>
                              <a data-slide="next" href="#c-slide" class="right carousel-control">
                                  <i class="arrow_carrot-right_alt2"></i>
                              </a>
                          </div>
                      </section>
                      <!--carousel end-->

                      <!--gritter notification start-->
                      <section class="panel">
                          <header class="panel-heading">
                              Gritter Notifications
                          </header>
                          <div class="panel-body">
                              <p class="">Click on below buttons to check it out.</p>
                              <a id="add-regular" class="btn btn-default btn-sm" href="javascript:;">Regular</a>
                              <a id="add-sticky" class="btn btn-success  btn-sm" href="javascript:;">Sticky</a>
                              <a id="add-without-image" class="btn btn-info  btn-sm" href="javascript:;">Imageless</a>

                              <a id="add-gritter-light" class="btn btn-warning  btn-sm" href="javascript:;">Light</a>
                              <a id="add-max" class="btn btn-primary  btn-sm" href="javascript:;">Max of 3</a>
                              <a id="remove-all" class="btn btn-danger  btn-sm" href="#">Remove all</a>
                          </div>
                      </section>
                      <!--gritter notification end-->

                  </div>
                  <div class="col-lg-6">
                      <section class="panel">                        
                        <header class="panel-heading">
                              Panels
                          </header>
                      <div class="panel-body">
                        <div class="panel panel-primary">
                          <div class="panel-heading">Panel heading</div>
                          <div class="panel-content">Panel content</div>
                        </div>          
                        <div class="panel panel-success">
                          <div class="panel-heading">Panel heading</div>
                          <div class="panel-content">Panel content</div>
                        </div>
                        <div class="panel panel-warning">
                          <div class="panel-heading">Panel heading</div>
                          <div class="panel-content">Panel content</div>
                        </div>
                        <div class="panel panel-danger">
                          <div class="panel-heading">Panel heading</div>
                          <div class="panel-content">Panel content</div>
                        </div>
                        <div class="panel panel-info">
                          <div class="panel-heading">Panel heading</div>
                          <div class="panel-content">Panel content</div>
                        </div>
                        </div>
                      </section>
                      <!--progress bar start-->
                      <section class="panel">
                          <header class="panel-heading">
                              Basic Progress Bars
                          </header>
                          <div class="panel-body">
                              <div class="progress progress-xs">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                      <span class="sr-only">60% Complete</span>
                                  </div>
                              </div>
                              <div class="progress progress-xs">
                                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                      <span class="sr-only">40% Complete (success)</span>
                                  </div>
                              </div>
                              <div class="progress progress-xs">
                                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                      <span class="sr-only">20% Complete</span>
                                  </div>
                              </div>
                              <div class="progress progress-xs">
                                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                      <span class="sr-only">60% Complete (warning)</span>
                                  </div>
                              </div>
                              <div class="progress progress-xs">
                                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                      <span class="sr-only">80% Complete</span>
                                  </div>
                              </div>
                              <p class="">
                                  Stacked Progress Bars
                              </p>
                              <div class="progress progress-sm">
                                  <div class="progress-bar progress-bar-success" style="width: 35%">
                                      <span class="sr-only">35% Complete (success)</span>
                                  </div>
                                  <div class="progress-bar progress-bar-warning" style="width: 20%">
                                      <span class="sr-only">20% Complete (warning)</span>
                                  </div>
                                  <div class="progress-bar progress-bar-danger" style="width: 10%">
                                      <span class="sr-only">10% Complete (danger)</span>
                                  </div>
                              </div>
                          </div>
                      </section>
                      <section class="panel">
                          <header class="panel-heading">
                              Striped Progress Bars
                          </header>
                          <div class="panel-body">
                              <div class="progress progress-striped progress-sm">
                                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                      <span class="sr-only">40% Complete (success)</span>
                                  </div>
                              </div>
                              <div class="progress progress-striped progress-sm">
                                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                      <span class="sr-only">20% Complete</span>
                                  </div>
                              </div>
                              <div class="progress progress-striped progress-sm">
                                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                      <span class="sr-only">60% Complete (warning)</span>
                                  </div>
                              </div>
                              <div class="progress progress-striped progress-sm">
                                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                      <span class="sr-only">80% Complete (danger)</span>
                                  </div>
                              </div>
                              <p class="">
                                  Animated Progress Bars
                              </p>
                              <div class="progress progress-striped active progress-sm">
                                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                      <span class="sr-only">45% Complete</span>
                                  </div>
                              </div>
                          </div>
                      </section>
                      <!--progress bar end-->

                      <!--collapse start-->
                      <div class="panel-group m-bot20" id="accordion">
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                          Collapsible Group Item #1
                                      </a>
                                  </h4>
                              </div>
                              <div id="collapseOne" class="panel-collapse collapse in">
                                  <div class="panel-body">
                                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </div>
                              </div>
                          </div>
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                          Collapsible Group Item #2
                                      </a>
                                  </h4>
                              </div>
                              <div id="collapseTwo" class="panel-collapse collapse">
                                  <div class="panel-body">
                                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </div>
                              </div>
                          </div>
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                  <h4 class="panel-title">
                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                          Collapsible Group Item #3
                                      </a>
                                  </h4>
                              </div>
                              <div id="collapseThree" class="panel-collapse collapse">
                                  <div class="panel-body">
                                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!--collapse end-->

                      <!--label and badge start-->
                      <section class="panel">
                          <div class="panel-body">
                              <p class=" text-center">Labels</p>
                              <p class="text-center">
                                  <span class="label label-default">label</span>
                                  <span class="label label-primary">Primary</span>
                                  <span class="label label-success">Success</span>
                                  <span class="label label-info">Info</span>
                                  <span class="label label-inverse">Inverse</span>
                                  <span class="label label-warning">Warning</span>
                                  <span class="label label-danger">Danger</span>
                              </p>
                              <p class=" text-center">Badges</p>
                              <p class="m-bot-none text-center">
                                  <span class="badge">5</span>
                                  <span class="badge bg-primary">10</span>
                                  <span class="badge bg-success">15</span>
                                  <span class="badge bg-info">20</span>
                                  <span class="badge bg-inverse">25</span>
                                  <span class="badge bg-warning">30</span>
                                  <span class="badge bg-important">35</span>
                              </p>
                          </div>
                      </section>
                      <!--label and badge end-->

                      <!--pagination start-->
                      <section class="panel">
                          <div class="panel-body">
                              <div>
                                  <ul class="pagination pagination-lg">
                                      <li><a href="#">«</a></li>
                                      <li><a href="#">1</a></li>
                                      <li><a href="#">2</a></li>
                                      <li><a href="#">3</a></li>
                                      <li><a href="#">4</a></li>
                                      <li><a href="#">5</a></li>
                                      <li><a href="#">»</a></li>
                                  </ul>
                              </div>
                              <div class="text-center">
                                  <ul class="pagination">
                                      <li><a href="#">«</a></li>
                                      <li><a href="#">1</a></li>
                                      <li><a href="#">2</a></li>
                                      <li><a href="#">3</a></li>
                                      <li><a href="#">4</a></li>
                                      <li><a href="#">5</a></li>
                                      <li><a href="#">»</a></li>
                                  </ul>
                              </div>
                              <div>
                                  <ul class="pagination pagination-sm pull-right">
                                      <li><a href="#">«</a></li>
                                      <li><a href="#">1</a></li>
                                      <li><a href="#">2</a></li>
                                      <li><a href="#">3</a></li>
                                      <li><a href="#">4</a></li>
                                      <li><a href="#">5</a></li>
                                      <li><a href="#">»</a></li>
                                  </ul>
                              </div>
                          </div>
                      </section>
                      <!--pagination end-->

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
    <!-- custome script for all page -->
    <script src="js/scripts.js"></script>
  

  </body>
</html>
