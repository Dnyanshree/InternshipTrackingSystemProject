<?php 
include('connect.php'); 
$page = "all";
include('session.php'); 
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
					<h3 class="page-header"><i class="fa fa-table"></i>Internship Detail</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						 <li><i class="fa fa-table"></i><a href="studentinternshipsearch.php">Internship Search</a></li> 
						<li><i class="fa fa-th-list"></i>Internship Detail</li>
					</ol>
				</div>
			</div>
              <!-- page start-->
              <div class="row">
			
				</div>
				
			<div class="row">
				<div class="col-lg-12">
					
                    <!-- pragya code start -->
                    <?php
                        $prsndetails = $_SESSION['username']['qry'];
                        $person_id=$result['person_id'];

                        $q = $db->query("SELECT student_id FROM student WHERE person_id='".$person_id."'");
                        $f = $q->fetch();
                        $student_id = $f['student_id'];
                        
                    if(isset($_GET["id"]))
                    {

                        $internship_id=$_GET["id"];
                         $stmt = $db->prepare("SELECT placement_id FROM placements WHERE internship_id=:internship_id AND student_id =:student_id
                            ");
                        $stmt->execute(array(':internship_id' => $internship_id,
                                            ':student_id' => $student_id));
                        $placed = $stmt->fetch();

                        $stmt = $db->prepare("SELECT * FROM internship as I, business as B WHERE B.business_id=I.business_id AND I.internship_id = :internship_id
                            ");
                        $stmt->execute(array(':internship_id' =>$internship_id));
                        $row = $stmt->fetch();?>

                        <section class="panel">
                          <header class="panel-heading">
                             Form Elements
                          </header>
                          <div id="newform" class="panel-body">
                              <form class="form-horizontal " method="get">
                                 
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Business Name</label>
                                      <div class="col-sm-10">
                                          
                                          <span class="help-block"><?php echo $row["business_name"] ?></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Business Type</label>
                                      <div class="col-sm-10">
                                          
                                          <span class="help-block"><?php echo $row["business_type"];?></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Job Tittle</label>
                                      <div class="col-sm-10">
                                          
                                          <span class="help-block"><?php echo $row["job_title"];?></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Contact Name</label>
                                      <div class="col-sm-10">
                                          
                                          <span class="help-block"><?php echo $row["contact_name"];?></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Contact Email</label>
                                      <div class="col-sm-10">
                                          
                                          <span class="help-block"><?php echo $row["contact_email"];?></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Job Description</label>
                                      <div class="col-sm-10">
                                          
                                          <span class="help-block"><?php echo $row["job_desc"];?></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Pay</label>
                                      <div class="col-sm-10">
                                          
                                          <span class="help-block"><?php echo $row["pay"];?></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Weekly Hours Required</label>
                                      <div class="col-sm-10">
                                          
                                          <span class="help-block"><?php echo $row["weekly_hours_required"];?></span>
                                      </div>
                                  </div>
                                   <div class="form-group">
                                      <label class="col-sm-2 control-label">Start Date</label>
                                      <div class="col-sm-10">
                                          
                                          <span class="help-block"><?php echo $row["start_date"];?></span>
                                      </div>
                                  </div>
                                   <div class="form-group">
                                      <label class="col-sm-2 control-label">End Date</label>
                                      <div class="col-sm-10">
                                          
                                          <span class="help-block"><?php echo $row["end_date"];?></span>
                                      </div>
                                  </div>
                                 
                              </form>
                          </div>
                      </section>

                    
                    <?php
                        
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

					echo '
					<script>
					location.href="studentinternshipsearch.php?applied=1"
					</script>';
                    header('Location: studentinternshipsearch.php');
                    
                    }


                    if(empty($placed))
                    {
                    ?>
                    <form id="apply" method="post" action="internshipDetail.php?id=<?php echo $internship_id ;?>">
                
                    <input type=submit class="btn btn-primary" name="submit" value="Apply For Internship">
                    </form>

                    <p id="demo"></p>

                    <?php 
                    }
                    else
                    {
                        echo "Already applied";
                    }

                    ?>
                    <!-- pragya code end -->
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
