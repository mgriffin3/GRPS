<?php
$servername = "localhost";
$username = "root";
$password = "root_123";
$dbname = "scraper";


session_start();

if (isset($_SESSION['email'])) {
//  	$_SESSION['msg'] = "You must log in first";
  	header('location: home.php');
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM challenges";
$result = $conn->query($sql);
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
        <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        
		<!-- Theme Styles -->
        <link href="assets/css/scrapper.css" rel="stylesheet" type="text/css"/>
       
        
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
                                <div class="panel-heading">
                                    <h4 class="panel-title">Trending Challenges</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive project-stats">  
                                       
                                           
										   <?php
										   
										   if ($result->num_rows > 0) {
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
												while($row = $result->fetch_assoc()) {
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
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/classie/classie.js"></script>
        <script src="assets/plugins/waves/waves.min.js"></script>
		<script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
		<script src="assets/js/underscore-min.js"></script>
        <script src="assets/js/scrapper.js"></script>
		<script src="assets/js/pages/table-data.js"></script>
    </body>
</html>