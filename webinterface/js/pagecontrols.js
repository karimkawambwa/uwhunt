

window.onload = function() {/*

				showLeft = document.getElementById( 'showLeft' ),
*/
/* showRightPush = document.getElementById( 'showRightPush' ), */
			
			var	menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				regRight = document.getElementById( 'cbp-spmenu-reg' ),
				showRightPush = document.getElementById( 'reg' ),
				backToLogin = document.getElementById( 'back_to_login' ),
				cancelSignup = document.getElementById( 'cancel' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				page1link = document.getElementById( 'page1Link' ),
				page2link = document.getElementById( 'page2Link' ),
				explore = document.getElementById( 'explore' ),
				posthouse = document.getElementById( 'posthouse' ),
				contactus = document.getElementById( 'contactus' ),
				team = document.getElementById( 'team' ),
				explore_page = document.getElementById( 'explore_page' ),
				posthouse_page = document.getElementById( 'posthouse_page' ),
				contactus_page = document.getElementById( 'contactus_page' ),
				team_page = document.getElementById( 'team_page' ),
				page1 = document.getElementById( 'page1' ),
				page2 = document.getElementById( 'page2' ),
				body = document.body;
				showingLeft = false;
				showingRight = false;

			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				
				if (showingLeft == true){
					showingLeft = false;
				}else{
					showingLeft = true;
				}
				
				if (showingRight == true){ // close left view
				classie.toggle( body, 'cbp-spmenu-push-toleft' );
				classie.toggle( regRight, 'cbp-spmenu-open' );
				showingRight = false;
				}
				
				disableOther( 'showLeftPush' );
			};
			
			showRightPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toleft' );
				classie.toggle( regRight, 'cbp-spmenu-open' );
				
				if (showingRight == true){
					showingRight = false;
				}else{
					showingRight = true;
				}
				
				if (showingLeft == true){ // close left view
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				showingLeft = false;
				}
					

				disableOther( 'showRightPush' );
			};
			
			backToLogin.onclick = function() {
				classie.toggle( this, 'active' );
				showLeftPush.click();

				disableOther( 'showRightPush' );
			};
			
			cancelSignup.onclick = function() {
				classie.toggle( this, 'active' );
				showRightPush.click();
				disableOther( 'showRightPush' );
			};
			
			//jQuery time
			var current_fs, next_fs, previous_fs; //fieldsets
			var left, opacity, scale; //fieldset properties which we will animate
			var animating; //flag to prevent quick multi-click glitches
			
			$(".next").click(function(){
				if(animating) return false;
				animating = true;
				
				current_fs = $(this).parent();
				next_fs = $(this).parent().next();
				
				//activate next step on progressbar using the index of next_fs
				$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
				
				//show the next fieldset
				next_fs.show(); 
				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function(now, mx) {
						//as the opacity of current_fs reduces to 0 - stored in "now"
						//1. scale current_fs down to 80%
						scale = 1 - (1 - now) * 0.2;
						//2. bring next_fs from the right(50%)
						left = (now * 50)+"%";
						//3. increase opacity of next_fs to 1 as it moves in
						opacity = 1 - now;
						current_fs.css({'transform': 'scale('+scale+')'});
						next_fs.css({'left': left, 'opacity': opacity});
					}, 
					duration: 800, 
					complete: function(){
						current_fs.hide();
						animating = false;
					}, 
					//this comes from the custom easing plugin
					easing: 'easeInOutBack'
				});
			});
			
			$(".previous").click(function(){
				if(animating) return false;
				animating = true;
				
				current_fs = $(this).parent();
				previous_fs = $(this).parent().prev();
				
				//de-activate current step on progressbar
				$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
				
				//show the previous fieldset
				previous_fs.show(); 
				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function(now, mx) {
						//as the opacity of current_fs reduces to 0 - stored in "now"
						//1. scale previous_fs from 80% to 100%
						scale = 0.8 + (1 - now) * 0.2;
						//2. take current_fs to the right(50%) - from 0%
						left = ((1-now) * 50)+"%";
						//3. increase opacity of previous_fs to 1 as it moves in
						opacity = 1 - now;
						current_fs.css({'left': left});
						previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
					}, 
					duration: 800, 
					complete: function(){
						current_fs.hide();
						animating = false;
					}, 
					//this comes from the custom easing plugin
					easing: 'easeInOutBack'
				});
			});
			
			$(".submit").click(function(){
				return false;
			});
				 
			   ///////////////////////////NEW CALL///////////////////
				var apiUrl = "RequestControl.php?request=status";
				$.ajax({
					type: 'POST',
					url: apiUrl,
					data: null,
					dataType: 'json',

					success: function(data){ //that is, server sent a response.
					//alert(data);
						if(data.status == 'loggedIn'){
							$('#log-out-form').show();
							$('#log-in-form').hide();

							/*
$('#log-in-form').replaceWith('<p>Logged in as: '
								+data.username
								+'</p>'
								+'<input id="log-out" value="logout" name="command" class="custom-button" onclick="logout()"/>');
*/
								
							$("#loggedInMenu").show();
							$("#loggedOutMenu").hide();
							$("#logged_in_as").replaceWith('<h1 id="logged_in_as" align="right" >' 
												+ "Logged in as: " + data.username + '</h1>');
							//alert('hey');

						} else if (data.status == 'nologin'){
							$('#log-out-form').hide();
							$('#log-in-form').show();

							$("#loggedInMenu").hide();
							$("#loggedOutMenu").show();
							$("#logged_in_as").replaceWith('<h1 id="logged_in_as" align="right" >' 
												+ 'Not logged In' + '</h1>');
							//alert('hey');
						}
						else {
							//show error
							//alert('hey');
						}
					}
				});
			
}

/*
<li><a href="#"><i class="icon-user"></i>Profile</a></li>
		        <li><a href="#"><i class="icon-cog"></i>Settings</a></li>
		        <li><a href="#"><i class="icon-remove"></i>Log out</a></li>
*/
			
			
function hideLoginForm() {
		$("#log-in-form").hide();
        $("#log-out").show();
        $("#post-house").show();			}

function showLoginForm() {
		$("#log-in-form").show();
		$("#post-house").hide();
        $("#log-out").hide();
}

function show_Left() {
		document.getElementById( 'showLeftPush' ).click();
		document.getElementById( 'dd' ).click();
}

function show_Right() {
		document.getElementById( 'reg' ).click();
		document.getElementById( 'dd' ).click();

}

function disableOther( button ) {

		if( button !== 'showLeftPush' ) {
				classie.toggle( showLeftPush, 'disabled' );
				
		}
			
		if( button !== 'showRightPush' ) {
			classie.toggle( showLeftPush, 'disabled' );
		}
		
			/*
			if( button !== 'showLeft' ) {
								classie.toggle( showLeft, 'disabled' );
							}
							if( button !== 'showRight' ) {
								classie.toggle( showRight, 'disabled' );
							}
			
							
			*/
							/*
			if( button !== 'showRightPush' ) {
								classie.toggle( showRightPush, 'disabled' );
							}
			*/
	
}
			
			
