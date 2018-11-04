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

if (!isset($_SESSION['email'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}

if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
}


$email = $_SESSION['email'];
$result = $conn->query("SELECT * FROM users WHERE email = '".$email."'");
$row = $result->fetch_array(MYSQLI_ASSOC);
//$user_row = mysqli_fetch_assoc($result_user);
$name = $row['name'];
$user_id = $row['id'];
$msg = array();
$err = array();


if(isset($_GET['id'])) {
	$id = $_GET['id'];
	
	if(isset($_POST['save_note'])) {

	$note_temp = $_POST['note'];
	
	$note = nl2br(htmlentities($note_temp, ENT_QUOTES, 'UTF-8'));

		$sql = "SELECT * from notes WHERE user_id = $user_id AND challenge_id = $id";
			$result_fav = $conn->query($sql);
			if ($result_fav->num_rows == 1) {
				$sql = "UPDATE notes SET note = \"$note\" WHERE user_id = $user_id AND challenge_id = $id";
				$result_challenge = $conn->query($sql);
				array_push($msg, "Note updated");
			} else {
				$sql = "INSERT INTO notes (user_id, challenge_id, note) VALUES ($user_id, $id, \"$note\")";
				if ($conn->query($sql) === TRUE) {
					//echo "New record created successfully";
					array_push($msg, "Note added");
				} else {
					array_push($err, "Cannot update database");
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}

	}


	if(isset($_GET['fav'])) {
		$fav = $_GET['fav'];
		$sql = "SELECT * from favorites WHERE user_id = $user_id AND challenge_id = $id";
		$result_fav = $conn->query($sql);
		if ($result_fav->num_rows > 0) {
			$sql = "UPDATE favorites SET status = $fav WHERE user_id = $user_id AND challenge_id = $id";
			$result_challenge = $conn->query($sql);
			array_push($msg, "Favorite list updated");
		} else {
			$sql = "INSERT INTO favorites (user_id, challenge_id, status) VALUES ($user_id, $id,$fav)";
			if ($conn->query($sql) === TRUE) {
				//echo "New record created successfully";
				array_push($msg, "Added to favorite list");
			} else {
				array_push($err, "Cannot update database");
				//echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}

	}
	
	$sql = "SELECT fav.status as favorite,nt.note as user_note, ch.* FROM challenges as ch LEFT JOIN favorites as fav ON fav.user_id = $user_id && fav.challenge_id = ch.id LEFT JOIN notes as nt ON nt.user_id = $user_id && nt.challenge_id = ch.id WHERE ch.id = $id";
	$result_challenge = $conn->query($sql);
	$row_challenge = $result_challenge->fetch_array(MYSQLI_ASSOC);
	$difficulty = $row_challenge['difficulty'];
	$title = $row_challenge['title'];
	$desc = $row_challenge['description'];
	$hint = $row_challenge['hint'];
	$note = $row_challenge['user_note'];
	$solved = $row_challenge['solved'];
	$favorite = $row_challenge['favorite'];
}

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
                                        <h3 class="panel-title"><?php echo $title;?></h3>
                                    </div>
                                    <div class="panel-body">
										<div class="timeline-options">
										<span>Difficulty: <?php echo $difficulty;?> </span>
                                        <?php if($favorite == 1) { ?>
										
										<a href="challenge.php?id=<?php echo $id;?>&fav=0" class="favorite" style="opacity: 1; cursor: pointer; color: #e83232 !important"><i class="fa fa-heart"></i> Favorite</a>
										<?php } else { ?>
										<a href="challenge.php?id=<?php echo $id;?>&fav=1" class="favorite" style="cursor: pointer;"><i class="fa fa-heart-o"></i> Favorite</a>
										<?php }  if($solved == 1) { ?> <a style="opacity: 1; cursor: pointer; color: #1DB198 !important"><i class="fa fa-check"></i></a> <?php } ?>
										<a href="#" class="" data-toggle="modal" data-target="#myNoteModal"><i class="fa fa-edit"></i> Edit Note</a>
										</div>
                                        <div role="tabpanel">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#tab5" role="tab" data-toggle="tab" aria-expanded="false">Description</a></li>
                                                <li role="presentation" class=""><a href="#tab6" role="tab" data-toggle="tab" aria-expanded="true">Hints</a></li>
                                                <li role="presentation" class=""><a href="#tab7" role="tab" data-toggle="tab" aria-expanded="false">Notes</a></li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade active in" id="tab5">
                                                    <p><?php echo $desc;?></p>
													<!-- <p>You may assume the two numbers do not contain any leading zero, except the number 0 itself.</p> 
													<div class="panel panel-default">
														<div class="panel-heading">
															<h3 class="panel-title">Example</h3>
														</div>
														<div class="panel-body">
															<p><b>Input: </b>(2 -> 4 -> 3) + (5 -> 6 -> 4)</p>
															<p><b>Output: </b>7 -> 0 -> 8</p>
															<p><b>Explanation: </b>342 + 465 = 807.</p>
														</div>
													</div> -->
													
												</div>
                                                <div role="tabpanel" class="tab-pane fade" id="tab6">
                                                    <ul><li><?php echo $hint;?></li></ul>
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="tab7">
                                                    <p><?php echo $note;?></p>
                                                </div>
                                            </div>
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
	
		<div class="modal fade" id="myNoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<form action="challenge?id=<?php echo $id;?>" method="post">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" >Update Note</h4>
						</div>
						<div class="modal-body">
						
                        <div class="form-group">
							<textarea id="note" name="note" style="width: 100%; height: 200px;"><?php echo $note;?></textarea>
                        </div>   
                        <div class="form-group">
							<p id="remain">Char left: 500</p>
                        </div> 
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<input type="submit" id="save_note" name="save_note" class="btn btn-success" value="Save"></input>
						</div>
						</form>
					</div>
				</div>
			</div>
			

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/pace-master/pace.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
		<script src="assets/js/underscore-min.js"></script>
        <script src="assets/js/scrapper.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
		
    </body>
</html>