<?php
	include_once('PageDefaultComponents.php');
	$pageDefaultComponents = new PageDefaultComponents('Hunt');
	$pageDefaultComponents->getComponents();
?>
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-reg">
		<h3>Signup</h3>
		<h1 id="reg-indicator"></h1>

		<h1>
		    <!--<input id="firstname" name="firstname" class="text-field" placeholder="First Name">
		    <input id="lastname" name="lastname" class="text-field" placeholder="Last Name">-->
		    <!--<input id="username" name="username" class="text-field" placeholder="Username">-->
		    <form method="POST" action ="RequestControl.php?request=studentSignUp">
			    <input id="studentEmail" type ='email' name="studentEmail" class="text-field" placeholder="E-mail">
			    <input id="enteredPassword" type ='password' name="enteredPassword" class="text-field" placeholder="Password">
			    <input id="confirmPassword" type ='password' name="confirmPassword" class="text-field" placeholder="Enter Password Again">			      		      
				<!--<input id="phone_number" name="phone_number" class="text-field" placeholder="Phone number"><br><br>-->
			    <!--<input id="allow_calling" name="allow_calling" type="checkbox" value="1">--><!--Check to allow calls. Uncheck to allow only texts.			--> 
			    
				<!--<input value="Submit" class="custom-button" onclick="signup()" style="cursor: pointer;"/>-->
				<input value="Submit" type="button" class="custom-button" onclick="signupStudent()" style="cursor: pointer;"/>
				<input id="back_to_login" value="Login" name="command" class="custom-button" style="cursor: pointer;"/>
				<input  id="cancel" value="Cancel" name="command" class="custom-button" style="cursor: pointer;"/>
			</form>
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
