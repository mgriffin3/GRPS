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

// REGISTER USER
if (isset($_POST['submit'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($email) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (name, email, password) 
  			  VALUES('$name', '$email', '$password')";
  	mysqli_query($conn, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: home.php');
  }
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
            <div class="navbar">
                <div class="navbar-inner container">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="index.php" class="logo-text"><span>GSRT Challenge Scrapper</span></a>
                    </div><!-- Logo Box -->
                    <div class="search-button">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                    </div>
                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-right">
                             	<li class="dropdown navbar-search">
									<a>
									<div class="input-group input-append search-input-div" id="showRight">
										<input id="search-input" type="text" class="form-control" style="border:none;" placeholder="Search">
									</div>
									</a>
								</li>
								<li class="dropdown navbar-search">
								<a>
									<div class="btn-group" id="showRight">
										<button type="button" class="btn btn-default">Search</button>
										<button type="button" class="btn btn-default">Advance Search</button>
									</div>
									</a>
								</li>
                                <li>
                                    <a href="login.php" class="waves-effect waves-button waves-classic" id="showRight">
                                        Login
                                    </a>
                                </li>
								<li>
                                    <a href="register.php" class="waves-effect waves-button waves-classic" id="showRight">
                                        Register
                                    </a>
                                </li>
                            </ul><!-- Nav -->
                        </div><!-- Top Menu -->
                    </div>
                </div>
            </div><!-- Navbar -->
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
                               
                                <p class="text-center m-t-md">Create an account</p>
                                <form class="m-t-md" method="post" action="register.php">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                    </div>
                                    <!-- <label>
                                        <div class="checker"><span><input type="checkbox"></span></div> Agree the terms and policy
                                    </label> -->
                                    <input type="submit" name="submit" class="btn btn-success btn-block m-t-xs" value="Submit"></input>
                                    <p class="text-center m-t-xs text-sm">Already have an account?</p>
                                    <a href="login.php" class="btn btn-default btn-block m-t-xs">Login</a>
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