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
				</div>
				
			<div class="row">
				<div class="col-lg-12">
					

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
