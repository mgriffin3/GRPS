<?php
$servername = "localhost";
$username = "root";
$password = "root_123";
$dbname = "scraper";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

session_start();

if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
}

if (isset($_SESSION['email'])) {
//  $_SESSION['msg'] = "You must log in first";
//  header('location: login.php');



$email = $_SESSION['email'];
$result = $conn->query("SELECT * FROM users WHERE email = '".$email."'");
$row = $result->fetch_array(MYSQLI_ASSOC);
//$user_row = mysqli_fetch_assoc($result_user);
$name = $row['name'];
$user_id = $row['id'];
}

$msg = array();
$err = array();

$sql = "SELECT * from challenges WHERE id > 0 ";

if(isset($_GET['str'])) {
	$str = $_GET['str'];
	$sql .= " AND title LIKE '%$str%'";
	
}

if(isset($_GET['slv'])) {
	$str = $_GET['slv'];
	if($str != ""){
		$sql .= " AND solved = $str";
	}
}

if(isset($_GET['diff'])) {
	$str = $_GET['diff'];
	if($str != ""){
		$sql .= " AND difficulty = '$str'";
	}
}



$result_ch = $conn->query($sql);



?>


<!DOCTYPE html>
<html>
    <head>
        
        <!-- Title -->
        <title>GSRT Challenge Scrapper</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="GSRT Challenge Scrapper" />
        <meta name="keywords" content="gsrt,challenge,scrapper" />
        <meta name="author" content="Kirit Soheliya" />
        
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        	
        <!-- Theme Styles -->
		<link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/scrapper.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/flash.css" rel="stylesheet" type="text/css"/>
        
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body class="page-header-fixed compact-menu page-horizontal-bar">
        <div class="overlay"></div>
        <form class="search-form" action="#" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                </span>
            </div><!-- Input Group -->
        </form><!-- Search Form -->
        <main class="page-content content-wrap">
            
			<?php include_once("navbar.php"); ?>
			
            <div class="page-inner">
                <div class="page-title">
                    <div class="containe1r">
                        <h3>Dashboard</h3>
                    </div>
                </div>
			    <div id="main-wrapper" class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title"><?php echo $result_ch->num_rows;  ?> results found.</h4>
                                </div>
                                <div class="panel-body">
                                   <div class="table-responsive">
                                    <?php
										   if ($result_ch->num_rows > 0) {
												echo "<table id=\"example\" class=\"display table\" style=\"width: 100%; cellspacing: 0;\">
													<thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>Challenge</th>
                                                   <th>Difficulty</th>
                                               </tr>
                                           </thead><tbody>";
												// output data of each row
												$i = 0;
												while($row = $result_ch->fetch_assoc()) {
													$i++;
													echo "<tr><td>".$i."</td><td><a href=\"challenge?id=".$row["id"]."\">".$row["title"]."</a></td><td><span class=\"label label-primary\">".$row["difficulty"]."</span></td></tr>";
												}
												echo "</table></tbody>";
											} else {
												echo "0 results";
											}
											$conn->close();
										   ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Main Wrapper -->
				
				<div id="flash-container">
					<?php foreach ($msg as $ms) { ?>
					<div id="flash-message" class="alert alert-box-fixed0 alert-box-fixed alert-minimalist alert-dismissible animated fadeInDown alert-info" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<span data-flash="message" class="flash-message"><?php echo $ms;?></span>
					</div>
					<?php } ?>

					<?php foreach ($err as $er) { ?>
					<div id="flash-message" class="alert alert-box-fixed0 alert-box-fixed alert-minimalist alert-dismissible animated fadeInDown alert-danger" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<span data-flash="message" class="flash-message"><?php echo $er;?></span>
					</div>
					<?php } ?>
				</div>
				
				
                <div class="page-footer">
                    <div class="container">
                        <p class="no-s">2018 © GSRT Challenge Scrapper.</p>
                    </div>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        <div class="cd-overlay"></div>
	

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/pace-master/pace.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
		<script src="assets/js/underscore-min.js"></script>
        <script src="assets/js/scrapper.js"></script>
        <script src="assets/js/pages/table-data.js"></script>

    </body>
</html>