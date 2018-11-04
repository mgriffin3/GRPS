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
										<button type="button" id="search" class="btn btn-default">Search</button>
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Advance Search</button>
									</div>
									</a>
								</li>
								<?php if(isset($name)) { ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <span class="user-name"> <?php echo $name; ?><i class="fa fa-angle-down"></i></span>
                                        <img class="img-circle avatar" src="assets/images/avatar.png" width="40" height="40" alt="">
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
                                        <li role="presentation"><a href="profile.php"><i class="fa fa-user"></i>Profile</a></li>
                                        <li role="presentation"><a href="logout.php"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                                    </ul>
                                </li>
								<?php } else { ?>
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
								<?php } ?>
								
                            </ul><!-- Nav -->
                        </div><!-- Top Menu -->
                    </div>
                </div>
            </div><!-- Navbar -->
			
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Advance Search</h4>
						</div>
						<div class="modal-body">
						<form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="search-input" class="col-sm-2 control-label">Keyword</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Keyword">  
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Difficulty</label>
                                        <div class="col-sm-10">
                                            <select id="diff" name="diff" class="form-control">
												<option value="">Easy/Difficult</option>
												<option value="Easy">Easy</option>
												<option value="Difficult">Difficult</option>
											</select>
									    </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-10">
                                            <select id="slv" name="slv" class="form-control">
												<option value="">Solved/Unsolved</option>
												<option value="1">Solved</option>
												<option value="0">Unsolved</option>
											</select>
									    </div>
                                    </div>
                                </form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" id="advance_search" class="btn btn-success">Search</button>
						</div>
					</div>
				</div>
			</div>
			