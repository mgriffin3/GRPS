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

$errors = array();
$msg = array();

if(isset($_SESSION['msg'])){
array_push($errors,$_SESSION['msg']);
unset($_SESSION['msg']);
}

// REGISTER USER
if (isset($_POST['submit'])) {
  // receive all input values from the form
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  //$user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
//  $result = mysqli_query($conn, $user_check_query);
//  $user = mysqli_fetch_assoc($result);

 if (count($errors) == 0) {
	$password = md5($password);
	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$results = mysqli_query($conn, $query);
	if (mysqli_num_rows($results) == 1) {
	  $_SESSION['email'] = $email;
	  $_SESSION['success'] = "You are now logged in";
	  header('location: home.php');
	}else {
		array_push($errors, "Wrong username/password combination");
	}
  }
/*  
  if ($email) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
*/
}

$sql = "SELECT * FROM challenges";
$result = $conn->query($sql);


//$sql = "SELECT * FROM challenges";
//$result = $conn->query($sql);
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
        <link href="assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        	
        <!-- Theme Styles -->
		<link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/scrapper.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
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
                        <div class="col-lg-4 col-md-4">
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
						<div class="col-lg-8 col-md-8">
							<div class="login-box">
                                <p class="text-center m-t-md">Please login into your account.</p>
                                <form class="m-t-md" action="login.php" method="post">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password" required="">
                                    </div>
                                    <input type="submit" class="btn btn-success btn-block" name="submit" value="Submit" ></input>
                                    <!-- <a href="forgot.php" class="display-block text-center m-t-md text-sm">Forgot Password?</a> -->
                                    <p class="text-center m-t-xs text-sm">Do not have an account?</p>
                                    <a href="register.php" class="btn btn-default btn-block m-t-md">Create an account</a>
                                </form>
                                
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

					<?php foreach ($errors as $er) { ?>
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
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/waves/waves.min.js"></script>

		<script src="assets/js/underscore-min.js"></script>
        <script src="assets/js/scrapper.js"></script>
				
    </body>
</html>