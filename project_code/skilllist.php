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

    <title>List Skill | Internship Tracking System</title>

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
	#skillsmenulist a {
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
		window.location="func/deleteskill.php?id="+id;
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
		$skill_id = $_POST['skill_id'];
		$skill_name = $_POST['skill_name'];
		$skill_desc = $_POST['skill_desc'];
		

		$sql = "UPDATE skill SET skill_name=?, 
									skill_desc=?
									 WHERE skill_id=?";
		$q = $db->prepare($sql);
		$q->execute(array($skill_name,
						 $skill_desc
						 ));

		$update[0]=1;
		$update[1]=ucwords($skill_name);
	   
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
					<h3 class="page-header"><i class="fa fa-table"></i> List Skills</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="fa fa-table"></i>Skills</li>
						<li><i class="fa fa-th-list"></i>List Skills</li>
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
					echo "<h4 style=\"color:red; \">Skill Deleted Successfully</h4>";
					echo "</div>";
				}
				if($update[0]==1) {
					echo "<div class='col-lg-12'>";
					echo "<h4 style=\"color:green; \">Skill ".$update[1]." Updated Successfully</h4>";
					echo "</div>";
				}
				?>
                  <div class="col-lg-12">
                      <section class="panel">                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_calendar"></i> Skill Name</th>
                                 <th><i class="icon_calendar"></i> Skill Description</th>         
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
							  <?php
								/*-------------------------------Supervisor Listing--------------------------------*/
								$stmt = $db->prepare("SELECT * FROM skill ");
								$stmt->execute();
								while($row = $stmt->fetch())
								{
								?>
                              <tr>
                                 <td><?=ucwords($row['skill_name'])?></td>
                                 <td><?=($row['skill_description'])?></td>                                
                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" href="#" onclick="return funcdelete('<?php echo $row['skill_id']?>','<?php echo strtoupper($row['skill_name'])?>');"><i class="icon_check_alt2"></i> Remove</a>
                                      <a class="btn btn-danger"  href="#myModal-<?php echo $row['skill_id']?>" data-toggle="modal" ><i class="icon_check_alt2"></i> Edit</a>
                                  </div>
								  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-<?php echo $row['skill_id']?>" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content" style = "float:left;width:95%">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Edit Skill</h4>
                                          </div>
                                          <div class="modal-body">
                                              <form role="form" name="updateform" method="post" action="">
                                                  <div class="form-group">
                                                      <label class="col-lg-2" for="job_title">Skill Name: </label>
													  <div class=" col-lg-10">
														<input class="form-control" value="<?=$row['skill_name']?>" id="skill_name" type="text" name="skill_name" required />
													  </div>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3" for="skill_description">Skill Description: </label>
													  <div class=" col-lg-9">
														<textarea class="form-control" id="skill_description" type="text" name="skill_description">
															<?=strip_tags($row['skill_description'])?>
														</textarea>
													  </div>
                                                  </div>
                                                 	<input type="hidden" name="skillid" value="<?php echo $row['skill_id']?>" />
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
		  $("#skillsmenu").addClass("active");
		  $("#skillsmenulist").addClass("active2");
		  
	</script>
  </body>
</html>
