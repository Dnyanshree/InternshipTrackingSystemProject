<?php 
require('connect.php');
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
	#internshipsearchmenu a {
	  font-weight: bold;
	  color: #fff;
	}
	.form-group{float:left}
	</style>
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
  </head>
<?php
	function get_db() { 
		include('connect.php');
        /**
         * START OF CONNECTION CREATION AND DATABASE SELECTION
         */

        //connect to database using mysql_* (the old deprecated way)
        $link = mysql_connect($host, $username, $password);
        if(!$link) {
            die('Error: ' . mysql_error());
        }

        $dbSelected = mysql_select_db($database, $link);
        if(!$dbSelected) {
            die('Error: ' . mysql_error());
        }

        //connect to database using PDO (the new way)
        try {
            $db = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage() . '<br />';
            die();
        }

		return $db;
	}

	function get_internships () { 
		$file_db = get_db();
		$id_where = "";
		$where = "";
		$vals = array();
		$id_vals = array();
        
        if(isset($_GET['search']))
        {  
         
               
    		if($_GET['search'] != "")  {
    		 	$words = explode(" ", $_GET['search']);
    			
    			$id_where = " WHERE ";
    			
    			foreach($words as $word) {
                    
    				$word = "'%$word%'";    				
                    $id_where .= " "."job_title LIKE"." " .$word. " OR job_desc  LIKE "."  " .$word."OR";
    				
    			}
                $id_where = substr($id_where, 0, -2);
                $id_where.="AND internship_active=1";
               
    		}

        }
		#inefficient to select all matches and then filter down. purely for demo and to
		#have faceted query on its own for demonstration. Look into elasticsearch or solr for efficient faceting!
        if(!empty($id_where))
        {
            $stmt = $file_db->prepare("SELECT internship_id FROM internship $id_where");
            
        }
        else{
            
            $stmt = $file_db->prepare("SELECT internship_id FROM internship where internship_active=1 ");
        }
		
		$stmt->execute($id_vals);

		$ids_list = "";
		while($internship = $stmt->fetch()) { 
            
			$ids_list .= $internship['internship_id'] . ",";	
		}
         
		$ids_list = substr($ids_list, 0, -1);

		#return if we got no results from search!
		if($ids_list == "") { 
			return $stmt;
		}

		unset($_GET['search']);

		#if we have facets
		if(count($_GET) > 0) { 

			#handle specialCases

                if(isset($_GET["job_title"]))
                {
                    
        			     $title=$_GET["job_title"];
        				$where .= " AND job_title LIKE '%$title[0]%'";	
        				unset($_GET["job_title"]);
        			
                }
                 if(isset($_GET["job_desc"]))
                {
                    
                         $description=$_GET["job_desc"];
                        $where .= " AND job_desc LIKE '%$description[0]%'"; 
                        unset($_GET["job_desc"]);
                    
                }
              
            
    			if(isset($_GET["minPay"] )) { 
    				$where .= " AND pay >= $_GET[minPay] ";
    			}
                

    			if(isset($_GET["maxPay"] )) { 
    				$where .= " AND pay <= $_GET[maxPay] ";
    			}

    			unset($_GET["minPay"]);
    			unset($_GET["maxPay"]);
           
    			/*if(isset($_GET["minYear"] )){
    				$where .= " AND year >= $_GET[minYear] ";
    			}


    			if(isset($_GET["maxYear"])) {
    				$where .= " AND year <= $_GET[maxYear] ";
    			}

    			unset($_GET["minYear"]);
    			unset($_GET["maxYear"]);*/
            

			foreach($_GET as $key=>$value) {
				if(is_array($value)) {
					$where .= " AND $key IN (";
					foreach($value as $el) { 
						$where .= "?,";
						array_push($vals, $el);
					}
					$where = substr($where, 0, -1);
					$where .= ") ";
				}
				else { 
					$where .= " AND $key=? ";
					array_push($vals, $value);
				}
			}
		}

		$stmt = $file_db->prepare("SELECT * FROM internship WHERE internship_id IN ($ids_list) $where");
		$stmt->execute($vals);
       
		return $stmt;
	}

	function grid_view($stmt) { 
		$string = "";
      
		while ($internship = $stmt->fetch()) {
			//echo "<pre>";print_r($internship);exit;
			$string .= "
				<div class='col-md-10 col-sm-6'>
                            <div class='thumbnail'>
                                       
                                    <span class='label label-success'>Pay: $" . $internship["pay"] . "</span>
                                    <div class='caption'>
										<div class='row'>
										<div class='col-md-4 col-sm-4'>
											<h4 class='title'><strong>Job Title:</strong> <a href='internshipDetail.php?id=$internship[internship_id]'>" . $internship["job_title"] . "</a></h4>
											<ul class='list-unstyled'>
												<li><span><strong>Description:</strong> " . $internship["job_desc"] . "</span></li>
											</ul>
										</div>
										<div class='col-md-4 col-sm-4'>
											<br/>
											<ul class='list-unstyled'>
												<li><span><strong>Semester:</strong> " . $internship["semester"] . "</span></li>
												<li><span><strong>Weekly Hours Required:</strong> " . $internship["weekly_hours_required"] . "</span></li>
												<li><span><strong>Minimum GPA Required:</strong> " . $internship["min_gpa_required"] . "</span></li>
											</ul>
										</div>
										<div class='col-md-4 col-sm-4'>
											<strong>From:</strong> <br/> 
											".$internship["start_date"]."<br/>
											<strong>To:</strong> <br/> 
											".$internship["end_date"]."<br/>
										</div>
										</div>
                                    </div>
                                </div>
								</div>
								";
		}	
		
		if($string == "") { 
			if(isset($_GET['applied']))
			{
				echo "<h3 style='text-align:center'>APPLIED TO INTERNSHIP SUCCESSFULLY <br/> <a href='studentinternshipsearch.php'>Refresh Page</a></h3>";
			}
			else
				$string = "<h3 style='text-align:center'>NO RESULTS</h3>";
		}

		return $string;
	}

	function get_models () { 
		$file_db = get_db();
		return $file_db->query('SELECT DISTINCT I.business_id, B.business_name FROM internship as I, business as B WHERE B.business_id=I.business_id');
	}

	if($_GET["ajax"] == "true") {
        unset($_GET['ajax']);
        echo grid_view(get_internships());
        exit;
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
					<h3 class="page-header"><i class="fa fa-table"></i>Internship Search</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<!-- <li><i class="fa fa-table"></i>Internship Search</li> -->
						<li><i class="fa fa-th-list"></i>Internship Search</li>
					</ol>
				</div>
			</div>
              <!-- page start-->
              <div class="row">
			
				</div>
				
			<div class="row">
				<div class="col-lg-12">
					<div class="container">


            <div class="row">

                <div class="col-md-3 col-sm-4"> 
                    <!-- left sec -->
                    <div class="left-sec">
                        <div class="left-cont">
                            <form>
                                <div class="label_div">Type a keyword : </div>
                                <div class="input_container">
                                    <input  name="search" type="text" class="form-control"  id="country_id" onkeyup="autocomplet()">
                                    <ul id="country_list_id"></ul>
                                </div>
                            </form>
			                  <form class="filter-sec" id="facets">

                                <select name="business_id" class="form-control">
                                    <option value="">Company</option>
									<?php
										$result = get_models();
										
										foreach ($result as $m) {
									?>
											<option value="<?php echo $m['business_id'] ?>"><?php echo $m['business_name'] ?></option>
									<?php
										}
									?>
                                </select>
								<br/>
					<div class="label_div">Job title:</div>
				  <div class="input-control">
									<div>
										<input name="job_title[]" class="checkbox" id="Programmer" type="checkbox" value="Programmer" style="float:left; margin-right:5px" />
										<label for="Programmer" style="margin-top:4px">Programmer</label>
									</div>
									<div>
                                    <input name="job_title[]" class="checkbox" id="Tester" type="checkbox" value="Tester" style="float:left; margin-right:5px"  />
                                    <label for="Tester" style="margin-top:4px">Tester</label>
									</div>

									<div>
                                    <input name="job_title[]" class="checkbox" id="used" type="checkbox" value="used" style="float:left; margin-right:5px"  />
                                    <label for="used"  style="margin-top:4px">Backend Developer</label>
									</div>

									<div>
                                    <input name="job_title[]" class="checkbox" id="php_developer" type="checkbox" value="php developer" style="float:left; margin-right:5px"  />
                                    <label for="php_developer"  style="margin-top:4px">PHP Developer</label> 
									</div>

                                </div>
								<br/>
                                <div class="label_div">Pay:</div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <input name="minPay" id="minPay" type="text" class="form-control input-sm" placeholder="Low">
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <input name="maxPay" id="maxPay" type="text" class="form-control input-sm" placeholder="High">
                                    </div>
                                </div>



                               <!--  <h5>Year:</h5>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <input name="minYear" id="minYear" type="text" class="form-control input-sm" placeholder="1999">
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <input name="maxYear" id="maxYear" type="text" class="form-control input-sm" placeholder="2013">
                                    </div>
                                </div> -->
								<br/>

				<div class="label_div">Skills:</div>
				  <div class="input-control">
									<div>
                                    <input name="job_desc[]" class="checkbox" id="Mysql" type="checkbox" value="Mysql" style="float:left; margin-right:5px" />
                                    <label for="Mysql"  style="margin-top:4px">Mysql</label>
									</div>


									<div>
                                    <input name="job_desc[]" class="checkbox" id="php" type="checkbox" value="php" style="float:left; margin-right:5px" />
                                    <label for="php"  style="margin-top:4px">PHP</label>
									</div>

									<div>
                                    <input name="job_desc[]" class="checkbox" id="Java" type="checkbox" value="Java" style="float:left; margin-right:5px" />
                                    <label for="Java"  style="margin-top:4px">Java</label>
									</div>

                                   <!-- <input name="job_desc[]" class="checkbox" id="yellow" type="checkbox" value="yellow" />
                                    <label for="yellow">Yellow</label>

                                     <input name="job_desc[]" class="checkbox" id="silver" type="checkbox" value="silver" />
                                    <label for="silver">Silver</label>

                                    <input name="job_desc[]" class="checkbox" id="white" type="checkbox" value="white" />
                                    <label for="white">White</label>

                                    <input name="job_desc[]" class="checkbox" id="black" type="checkbox" value="black" />
                                    <label for="black">Black</label> -->

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /left sec -->
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="right-sec">
                        <div class="row" id="searchCont">
							<?php echo grid_view(get_internships()); ?>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>



            <hr>






            <hr>



        </div>

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

   <!--   <script type='text/javascript' src='js/jquery.deserialize.js'></script>  -->
    <script type='text/javascript' src='js/jquery.facets.js'></script>
    <script type='text/javascript' src='js/listing.js'></script>
    <script type="text/javascript" src="js/script.js"></script>

    <script src="assets/js/jquery.fs.selecter.js"></script>
    <script src="assets/js/jquery.fs.picker.js"></script>
    <script src="assets/js/jquery.fs.scroller.js"></script>

    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/theme.js"></script>
	<script>
		  $("#internshipsearchmenu").addClass("active");
		  $("#internshipsearchmenu").addClass("active2");

		  $(document).ready(function (e) {




            $(".selecter_label_1").selecter({
                defaultLabel: "Select a Make"
            });

            $(".selecter_label_2").selecter({
                defaultLabel: "Select A Model"
            });

            $(".selecter_label_3").selecter({
                defaultLabel: "Condition"
            });

            $(".selecter_label_4").selecter({
                defaultLabel: "Transmission"
            });


            $("input[type=checkbox], input[type=radio]").picker();

        });
		  
	</script>
  </body>
</html>
