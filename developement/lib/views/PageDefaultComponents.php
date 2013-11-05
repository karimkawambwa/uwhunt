<?php
	class PageDefaultComponents{
		public $pageHeader;
		public $pageTitle;
		public $pageSideMenu;
		public $pageTopMenu;

		public function __construct($_pageTitle){
			$this->pageTitle = $_pageTitle;

			$this->pageHeader = '<!DOCTYPE html>
									<html lang="en" class="no-js">
										<head>
											<meta charset="UTF-8" />
											<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
											<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
											<title>'.$this->pageTitle.'</title>
											<meta name="description" content="Chataloo - Hunt: Housing for Students, added by Students" />
											<meta name="keywords" content="house hunting, house, student" />
											<meta name="author" content="Karim" />
											<link rel="shortcut icon" href="../favicon.ico">
											<link rel="stylesheet" type="text/css" href="../../css/default.css" />
											<link rel="stylesheet" type="text/css" href="../../css/component.css" />
											<link rel="stylesheet" type="text/css" href="../../css/gridcomponents.css" />
											<link rel="stylesheet" type="text/css" href="../../css/multiform.css" />
											<link rel="stylesheet" type="text/css" href="../../css/header.css" />
											<link rel="stylesheet" type="text/css" href="../../css/forms.css" />
											<script src="../../js/jquery-1.9.1.min.js" type="text/javascript"></script>
											<script src="../../js/jquery.easing.min.js" type="text/javascript"></script>
											<script src="../../js/modernizr.custom.js"></script>
											<script src="../../js/functions.js"></script>
											<script src="../../js/classie.js"></script>
											<script src="../../js/pagecontrols.js"></script>
										</head>';
			$this->pageTopMenu = '<body class="cbp-spmenu-push">
								  <header>
									<div>
										<div id="menuOpen" style="width:90px; height:34px; background: white; float:left; 
											margin-left: 0px; margin-top: 14px; text-align:center; display:inline-block;">
											<a href="#" id="showLeftPush"> 
												<p style="color:black; font-family: calibri; margin-top:6px; font-weight:bold; font-size:120%" id="sideMenuTrigger">OPEN ></p>
											</a>
										</div>
										<h1 id="home">HUNT</h1> 
									</div>
									
									<nav>
										<a>How to Use</a>
										<a>Support us</a>
										<a id="page1Link">Contact Us</a>
										<a id="page2Link">Report issue</a>
										<a>About</a> 
										<a>Feedback</a>
										</br></br>
										<div id="dd" class="wrapper-dropdown-5" tabindex="1" ><h1 id="logged_in_as" align="right" > </h1>
											    <ul class="dropdown" id="dp" >
											    <div id="loggedInMenu">
											        <li><a href="#" id="dropdown-profile"><i class="icon-user"></i>Profile</a></li>
											        <li><a href="#" id="dropdown-settings"><i class="icon-cog"></i>Settings</a></li>
											        <li><a href="#" id="dropdown-logout" onclick="logoutStudent()"><i class="icon-remove"></i>Log out</a></li>
											    </div>
											    
											    
											    <div id="loggedOutMenu">
											        <li ><a href="#" id="dropdown-register" onclick="show_Right()"><i class="icon-cog"></i>Register</a></li>
											        <li><a href="#" id="dropdown-login" onclick="show_Left()"><i class="icon-remove"></i>Log in</a></li>
											    </div>
											    </ul>
											</div>
										</nav>
									</header>';
				//$this->pageSideMenu = setUpSideMenu();

		}

		public function setUpSideMenu(){
			/*check if user is logged in or not?*/
			/*
			 *On login, js takes care of removing the register/login button, after the ajax post
			 *This is mostly for all the other pages?
			 *I am not sure how this will work. Close attention will have to be paid to the side menu
			 *on different system states.
			 *In the meantime, I will just populate the side menu as it is; as if no one logged in.
			 *This will need to change
			 */
			$sideMenu = '<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
							<h3>House Hunt for University Students</h3>
							<h1>
								<div id="log-in-form">
									Username: <input id="uname" class="text-field" type="text" name="uname" placeholder="Username/Email"/><br><br>
									Password: <input id="pword" class="text-field" type="password" name="pword" placeholder="Password"/><br><br>
									<input  id="log-in" value="Login" name="command" class="custom-button" onclick="loginStudent()" style="cursor: pointer;"/>
									<input  id="reg" value="Register" name="command" class="custom-button" style="cursor: pointer;"/>
								</div>
							</h1>
							
							<a id="explore" href="#" onclick="document.getElementById("showLeftPush").click()">Explore		</a>
							<a id="posthouse" href="#" onclick="document.getElementById("showLeftPush").click()">Post House	</a>
							<a id="contactus" href="#" onclick="document.getElementById("showLeftPush").click()">Contact Us	</a>
							<a id="team" href="#" onclick="document.getElementById("showLeftPush").click()">Team		</a>
							 
						</nav>';
			echo $sideMenu;
		}

		public function getComponents(){
			echo $this->pageHeader . $this->pageTopMenu . $this->setUpSideMenu();
		}


	}
?>