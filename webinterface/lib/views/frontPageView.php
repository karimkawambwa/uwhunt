<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Chataloo HUNT</title>
		<meta name="description" content="Blueprint: Slide and Push Menus" />
		<meta name="keywords" content="sliding menu, pushing menu, navigation, responsive, menu, css, jquery" />
		<meta name="author" content="Karim" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="../../css/default.css" />
		<link rel="stylesheet" type="text/css" href="../../css/component.css" />
		<link rel="stylesheet" type="text/css" href="../../css/multiform.css" />
		<link rel="stylesheet" type="text/css" href="../../css/header.css" />
		<link rel="stylesheet" type="text/css" href="../../css/forms.css" />
		<script src="../../js/modernizr.custom.js"></script>
		
		<!--
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script>
-->
		<!-- jQuery -->
		<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<!-- jQuery easing plugin -->
		<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
				
		<script src="../../js/functions.js"></script>
		<script src="../../js/classie.js"></script>
		<script src="../../js/pagecontrols.js"></script>
		<!-- <script src="js/multiform.js"></script> -->
	</head>
	<body class="cbp-spmenu-push"  > <!-- onload="checkLogin()" -->
		<header>
			<div>
				<button id="showLeftPush" style=" width: 50px; height:50px; background: #176af2; border:none;">Menu</button><h1 id="home">HUNT</h1> 
			</div>
			
			<nav>
				<a>How to Use</a>
				<a>Support us</a>
				<a id="page1Link">Contact Us</a>
				<a id="page2Link">Report issue</a>
				<a>About</a> 
				<a>Feedback</a>
				</br></br><!-- <h3 id="logged_in_as" align="right"> </h3> -->
				
				<div id="dd" class="wrapper-dropdown-5" tabindex="1" ><h1 id="logged_in_as" align="right" > </h1>
				    <ul class="dropdown" id="dp" >
				    <div id="loggedInMenu">
				        <li><a href="#" id="dropdown-profile"><i class="icon-user"></i>Profile</a></li>
				        <li><a href="#" id="dropdown-settings"><i class="icon-cog"></i>Settings</a></li>
				        <li><a href="#" id="dropdown-logout" onclick="logout()"><i class="icon-remove"></i>Log out</a></li>
				    </div>
				    
				    
				    <div id="loggedOutMenu">
				        <li ><a href="#" id="dropdown-register" onclick="show_Right()"><i class="icon-cog"></i>Register</a></li>
				        <li><a href="#" id="dropdown-login" onclick="show_Left()"><i class="icon-remove"></i>Log in</a></li>
				    </div>
				    </ul>
				</div>
			</nav>
		</header>
		
	
		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<h3>House Hunt for University Students</h3>
			<!--<h1 id="indicator"></h1>-->
			<h1>
				<div id="log-in-form">
					Username: <input id="uname" class="text-field" type="text" name="uname" placeholder="Username/Email"/><br><br>
					Password: <input id="pword" class="text-field" type="password" name="pword" placeholder="Password"/><br><br>
					<input  id="log-in" value="login" name="command" class="custom-button" onclick="loginStudent()" style="cursor: pointer;"/>
					<input  id="reg" value="Register" name="command" class="custom-button" style="cursor: pointer;"/>
				</div>
				
				<div id="log-out-form">
					<input  id="log-out" value="logout"  name="command" class="custom-button" onclick="logoutStudent()"/>
				</div>
			</h1>
			
			<a id="explore" href="#" onclick="document.getElementById('showLeftPush').click()">Explore		</a>
			<a id="posthouse" href="#" onclick="document.getElementById('showLeftPush').click()">Post House	</a>
			<a id="contactus" href="#" onclick="document.getElementById('showLeftPush').click()">Contact Us	</a>
			<a id="team" href="#" onclick="document.getElementById('showLeftPush').click()">Team		</a>
			 
		</nav>

		
		
		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-reg">
			<h3>Signup</h3>
			<h1 id="reg-indicator"></h1>

			<h1>
			    <input id="firstname" name="firstname" class="text-field" placeholder="First Name">
			    <input id="lastname" name="lastname" class="text-field" placeholder="Last Name">
			    <input id="username" name="username" class="text-field" placeholder="Username">
			    <input id="pass1" type ='password' name="password" class="text-field" placeholder="Password">
			    <input id="pass2" type ='password' name="confirm" class="text-field" placeholder="Please confirm your password">			      		      
			    <input id="email" type ='email' name="email" class="text-field" placeholder="E-mail">
				<input id="phone_number" name="phone_number" class="text-field" placeholder="Phone number"><br><br>
			    <input id="allow_calling" name="allow_calling" type="checkbox" value="1"><!--Check to allow calls. Uncheck to allow only texts.			--> 
				<input value="Submit" class="custom-button" onclick="signup()"/>
				<input id="back_to_login" value="Login" name="command" class="custom-button" />
				<input  id="cancel" value="Cancel" name="command" class="custom-button" />
				<!-- onClick="location.href='http://www.chataloo.comli.com/web/register.html';" -->
			</h1>
			
		</nav>
		
		<div id="page1">
			<div class="form-wrapper">
				<form >
					<input  id="searchField" type="text" placeholder="Search here..." required>
					<button id="searchButton" type="button" onclick="search(document.getElementById('searchField').value)" >Search</button>
				</form>
			</div>
			<div class="main">
				<section>
					<h2>Search by:</h2>
					<!-- Class "cbp-spmenu-open" gets applied to menu -->
					<button id="search_by_city">	City		</button>
					<button id="search_by_work">	Workplace	</button>
					<button id="search_by_street">	Street		</button>
				</section>
					
				<section class="buttonset">
					<!-- <h2>Push Menus</h2> -->
					<!-- Class "cbp-spmenu-open" gets applied to menu and "cbp-spmenu-push-toleft" or "cbp-spmenu-push-toright" to the body -->
					<!-- <button id="showLeftPush">Show/Hide Left Push Menu</button> -->
				</section>
			</div>
		</div><!-- page1 end -->
		
		<div id="result-page">
			<div id="result">
			</div>
		</div>
		
	    <div id="page2">
			<p>Page 2</p>
	    </div>
	    
	    <div id="explore_page">
	    	<p>Explore.</p>
	    </div>
	    
	    
	    
	    <!--          POST A HOUSE          -->
	    
	    <div id="posthouse_page">
	    <!-- multistep form -->
				<form id="msform">
					<!-- progressbar -->
					<ul id="progressbar">
						<li class="active">House Details</li>
						<li>Owner Details</li>
						<li>Workplace Details</li>
					</ul>
					<!-- fieldsets -->
					<fieldset>
						<h2 class="fs-title">House Details</h2>
						<h3 class="fs-subtitle">step 1</h3>
						    
						    <table width="100%" class="subforum">
						    
						    <tr><input name="HouseStreet"  placeholder="Street"></tr>
						
						    <tr>
								<td>
									<input name="HouseCity"  placeholder="City">
						    	</td>
						    
						    	<td>
									<input name="HousePostalCode"  placeholder="Postal Code">
						    	</td>
						    </tr>
						    
						    <tr>
							    <tr>
								    <td>
								        <input name="HouseRating"  placeholder="Rating (out of 10)">
								    </td>
								    
								    <td>
										<input name="HouseConvenience"  placeholder="Convenience">
								    </td>
							    
							    	<td>
										<input name="HouseCapacity" class="app-input" placeholder="Capacity">
									</td>
							    </tr>
						    </tr>
						    
						     
						    
						    <tr>
						
						    <td>
						
						            <input name="HouseType" class="app-input" placeholder="Type (house, condo etc.)">
						
						    </td>
						    
							<td>
						
						            <input name="HouseCost"  placeholder="Cost">
						
						    </td>
						  
						
						    </tr>

					
						    </table>
						    
						<textarea name="HouseComments" class="app-input" placeholder="Comments"></textarea>

						<input type="button" name="next" class="next action-button" value="Next" />
					</fieldset>
					<fieldset>
						<h2 class="fs-title">LandLord/Lady</h2>
						<h3 class="fs-subtitle">Provide the owner's info</h3>
						<input name="OwnerFirstName" placeholder="Owner's First Name (optional)">
						<input name="OwnerLastName" placeholder="Owner's Last Name (optional)">
						<input name="OwnerPhoneNumber" placeholder="Owner's Phone Number (optional)">
						<input id="OwnerEmail" name="OwnerEmail" placeholder="* Owner's E-mail (must)">
						<input type="button" name="previous" class="previous action-button" value="Previous" />
						<input type="button" name="next" class="next action-button" value="Next" />
					</fieldset>
					<fieldset>
						<h2 class="fs-title">Workplace</h2>
						<h3 class="fs-subtitle">Where you work/worked when you lived here</h3>
						<input name="WorkplaceName"  placeholder="Co-op Employer">
						<input name="WorplaceCity"  placeholder="City">
						<input name="WorplaceProvince"  placeholder="Province">
						<input name="WorkplaceAddress" placeholder="Address">
						<input type="button" name="previous" class="previous action-button" value="Previous" />
						<input type="submit" name="submit" class="submit action-button" value="Submit" />
					</fieldset>
				</form>
				
				
	    
	    
	    
	    </div><!--         END POST A HOUSE          -->
	    
	    <div id="contactus_page">
	    <p>contact.</p>
	    </div>
	    
	    <div id="team_page">
	    <p>team.</p>
	    </div>
		
		<!-- Classie - class helper functions by @desandro https://github.com/desandro/classie -->
				
		<script>
		    // use $(document).ready function to
		    // make sure that the code executes only after the document's 
		    // DOM has been loaded into the browser.
		    $("#page2").hide();
	        $("#explore_page").hide();
	        $("#posthouse_page").hide();
	        $("#team_page").hide();
	        $("#contactus_page").hide();
	        $("#result-page").hide();
		    $(document).ready(function () { 
		        // when page1Link link is clicked, page1 shows, 
		        // page2 hides
		        $("#page1Link").bind("click", function () {
		            $("#page1").show();
		            $("#page2").hide();
			        $("#explore_page").hide();
			        $("#posthouse_page").hide();
			        $("#team_page").hide();
			        $("#contactus_page").hide();
		        });
		        
		        $("#home").bind("click", function () {
		            $("#page1").show();
		            $("#page2").hide();
			        $("#explore_page").hide();
			        $("#posthouse_page").hide();
			        $("#team_page").hide();
			        $("#contactus_page").hide();
		        });
		
		        // when page2Link link is clicked, page2 shows, 
		        // page1 hides
		        $("#page2Link").bind("click", function () {
		            $("#page1").hide();
		            $("#page2").show();
			        $("#explore_page").hide();
			        $("#posthouse_page").hide();
			        $("#team_page").hide();
			        $("#contactus_page").hide();
		        });
		        
		        $("#explore").bind("click", function (){
			        $("#page1").hide();
			        $("#page2").hide();
			        $("#explore_page").show();
			        $("#posthouse_page").hide();
			        $("#team_page").hide();
			        $("#contactus_page").hide();
				});
		        
		        $("#posthouse").bind("click", function (){
			        $("#page1").hide();
			        $("#page2").hide();
			        $("#explore_page").hide();
			        $("#posthouse_page").show();
			        $("#team_page").hide();
			        $("#contactus_page").hide();
				});
				$("#team").bind("click", function (){
			        $("#page1").hide();
			        $("#page2").hide();
			        $("#explore_page").hide();
			        $("#posthouse_page").hide();
			        $("#team_page").show();
			        $("#contactus_page").hide();
				});
				$("#contactus").bind("click", function (){
			        $("#page1").hide();
			        $("#page2").hide();
			        $("#explore_page").hide();
			        $("#posthouse_page").hide();
			        $("#team_page").hide();
			        $("#contactus_page").show();
				});
				
							  		        
		    });
		    
		</script>
		
		<script type="text/javascript">

			function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});	
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-5').removeClass('active');
				});

			});

		</script>
	</body>
</html>
