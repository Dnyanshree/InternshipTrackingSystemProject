<?php
	include('connect.php'); 
	$page = "all";
	include('session.php');
	$prsndetails = $_SESSION['username']['qry'];
	$person_id=$result['person_id'];


  if(isset($_POST))
  {

    /*------------student details---------*/
    $major = $_POST['major'];
    $current_semester = $_POST['current_semester'];
    $gpa = $_POST['gpa'];

   
   $sql = "INSERT INTO student (person_id,major,current_semester,gpa) VALUES (:person_id,:major,:current_semester,:gpa )";
	    $q = $db->prepare($sql);    
	    $q->execute(array(':person_id'=>$person_id,
	    				 ':major'=>$major,
	    				 ':current_semester'=>$current_semester,
	    				  ':gpa'=>$gpa,
	                    ));
						
	header('studentinternshipsearch.php');
	}

 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="shortcut icon" href="img/favicon.png">

    <title> Internship Search</title>

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
    #newform .form-group{width: 100%}
	.form-group{float:left}
	</style>
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
  </head>


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
					<h3 class="page-header"><i class="fa fa-table"></i>Course Detail</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						 <li><i class="fa fa-table"></i>Course Search</li> 
						
					</ol>
				</div>
			</div>
              <!-- page start-->
              <div class="row">
			
				</div>
				
			<div class="row">
				<div class="col-lg-12">
					
                    
                        <section class="panel">
                          
                          <div id="newform" class="panel-body">
						  
                              	<form class="form-horizontal" name="studentForm" method="post" action="courseDetail.php">
								  <div class="form-group">
									  <label class="col-sm-2 control-label"><B>Major</B></label>
									  <div class="col-sm-10">
										  <input type="text" placeholder="Major" name="major" class="form-control">
									  </div>
								  </div>
								   <div class="form-group">
									  <label class="col-sm-2 control-label"><B>Current Semester</B></label>
									  <div class="col-sm-10">
										  <input type="text" placeholder="Current Semester" name="current_semester" class="form-control">
									  </div>
								  </div>
								   <div class="form-group">
									  <label class="col-sm-2 control-label"><B>GPA</B></label>
									  <div class="col-sm-10">
										  <input type="text" placeholder="GPA" name="gpa" class="form-control">
									  </div>
								  </div>
								  <input type=submit class="btn btn-primary"  name="submit" value="submit">
							  </form>
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
    <!-- nicescroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>


	<script>
		  $("#internshipsmenu").addClass("active");
		  $("#internshipmenuassign").addClass("active2");

	
		  
	</script>
  </body>
</html>

