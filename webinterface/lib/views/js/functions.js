function test(){
	alert('test');
}

function testsearch(){
	alert('test');
}

function hideLoginForm() {
					$("#log-in-form").hide();
					$("#post-house").show();
		            $("#log-out").show();
			}
			
function showLoginForm() {
		$("#log-in-form").show();
		$("#post-house").hide();
		$("#log-out").hide();
}

function login() { // This event fires when a button is clicked
  		
  	  var _data =  "command=login" + "&username=" + document.getElementById('uname').value +
								 "&password=" + document.getElementById('pword').value  ;
	
	  document.getElementById("indicator").innerHTML = "verifying...";
	  
	   $.ajax({ // ajax call starts
		  	  type: "POST",
			  url: 'database/access.php', // JQuery loads serverside.php
			  data: _data, // Send value of the clicked button
			  dataType: 'json', // Choosing a JSON datatype
			  success: function(data) // Variable data contains the data we get from serverside
			  {
					 if (data.Response.Login == 'SUCCESS'){
			 
						document.getElementById("indicator").innerHTML = ":) Success.";
				
						var userXM = data.Response.extraMap;
				
						document.getElementById("logged_in_as").innerHTML = "Logged in as: " 
															+ userXM.Firstname +" "
															+ userXM.Lastname +" ("
															+ userXM.Username + ")" ;
															
						document.getElementById("dp").innerHTML = '<li><a href="#"><i class="icon-user"></i>Profile</a></li>' 
																	+ '<li><a href="#"><i class="icon-cog"></i>Settings</a></li>'
																	+ '<li><a href="#"><i class="icon-remove"></i>Log out</a></li>' ;
													
						document.getElementById("indicator").innerHTML = ":) Success.";
						
						hideLoginForm();
						document.getElementById('showLeftPush').click();
				
					 }
				 
					 else if (data.Response.Login == 'LOGGED IN'){
						document.getElementById("indicator").innerHTML = data.Response.Message;
					 }
				 
					 else if (data.Response.Login == 'FAILED'){
						document.getElementById("indicator").innerHTML = data.Response.Message;
					 }
					 
					 else
					 {
						document.getElementById("indicator").innerHTML = ":( Something went horribly long. We are on it!";
					 }
				 
			  }
		});
}

function logout() { // This event fires when a button is clicked
	  
	   $.ajax({ // ajax call starts
		  	  type: "POST",
			  url: 'database/access.php', // JQuery loads serverside.php
			  data: "command=logout", // Send value of the clicked button
			  dataType: 'json', // Choosing a JSON datatype
			  success: function(data) // Variable data contains the data we get from serverside
			  {
					 if (data.Response.Login == 'LOGGED OUT'){
			 
						//document.getElementById("indicator").innerHTML = ":) Success.";
				
						document.getElementById("logged_in_as").innerHTML = "Not logged in.";
						
						document.getElementById("dp").innerHTML = '<li><a href="#"><i class="icon-cog"></i>Register</a></li>'
																	+ '<li><a href="#"><i class="icon-remove"></i>Log in</a></li>' ;
													
						//document.getElementById("indicator").innerHTML = ":) Success.";
						
						showLoginForm();
						document.getElementById('showLeftPush').click();
				
					 }
				 
					 else
					 {
						document.getElementById("indicator").innerHTML = ":( Something went horribly long. We are on it!";
					 }
				 
			  }
		});
}

/*
function checkLogin() { // This event fires when a button is clicked
  		
	  document.getElementById("logged_in_as").innerHTML = "checking...";
	  
	   $.ajax({ // ajax call starts
		  	  type: "POST",
			  url: 'database/access.php', // JQuery loads serverside.php
			  data: "command=status", // Send value of the clicked button
			  dataType: 'json', // Choosing a JSON datatype
			  success: function(data) // Variable data contains the data we get from serverside
			  {
					 if (data.Response.Login == 'LOGGED IN'){
			 
						document.getElementById("indicator").innerHTML = ":) Success.";
				
						var userXM = data.Response.extraMap;
				
						document.getElementById("logged_in_as").innerHTML = "Logged in as: " 
															+ userXM.Firstname +" "
															+ userXM.Lastname +" ("
															+ userXM.Username + ")" ;
													
						document.getElementById("indicator").innerHTML = ":) Success.";
						
						hideLoginForm();
						document.getElementById('showLeftPush').click();
				
					 }
				 
					 else if (data.Response.Login == 'NOT LOGGED IN'){
						document.getElementById("loggeg_in_as").innerHTML = data.Response.Message;
					 }
					 
					 else
					 {
						document.getElementById("indicator").innerHTML = ":( Something went horribly long. We are on it!";
					 }
				 
			  }
		});
}
*/

function signup() { // This event fires when a button is clicked

  if (document.getElementById('pass1').value == document.getElementById('pass2').value 
  && document.getElementById('pass1').value != ''
  && document.getElementById('pass2').value != ''){
  		
  		// alert ('firstname' + document.getElementById('firstname').value ); //test fields
//   		alert ('lastname' + document.getElementById('lastname').value );
//   		alert ('pass1' + document.getElementById('pass1').value );
//   		alert ('email' + document.getElementById('email').value );
//   		alert ('phone_number' + document.getElementById('phone_number').value );
//   		alert ('allow_calling' + document.getElementById('allow_calling').value );
  		
	  var _data =  "command=register" + "&firstname=" + document.getElementById('firstname').value +
										"&lastname=" + document.getElementById('lastname').value +
										"&username=" + document.getElementById('username').value +
										"&password=" + document.getElementById('pass1').value +
										"&email=" + document.getElementById('email').value +
										"&phone_number=" + document.getElementById('phone_number').value +
										"&allow_calling=" + document.getElementById('allow_calling').value ;
		
	  document.getElementById("reg-indicator").innerHTML = "loading...";
	  
	   $.ajax({ // ajax call starts
		  type: "POST",
			  url: 'database/access.php', // JQuery loads serverside.php
			  data: _data, //data, // Send value of the clicked button
			  dataType: 'json', // Choosing a JSON datatype
			  success: function(data) // Variable data contains the data we get from serverside
			  {
			
					if (data == 'email exists'){
						document.getElementById('email').value = "";
						document.getElementById("reg-indicator").innerHTML = "failed: " + data;
					}
					else if (data == 'username exists'){
						document.getElementById('username').value = "";
						document.getElementById("reg-indicator").innerHTML = "failed: " + data;
					}
					else if (data == 'success'){
						document.getElementById("reg-indicator").innerHTML = "Success";
						document.getElementById('cancel').click();
					}
					else if (data == 'failed'){
						document.getElementById("reg-indicator").innerHTML = "Failed";
					}
					else
					{
						alert(data);
						document.getElementById("reg-indicator").innerHTML = data + " :( Something went really wrong, be assured we are on it!";
					}
			  
			  }
	  });
			
	  
	  }else{
	  
		  document.getElementById('pass1').value = "";
		  document.getElementById('pass2').value = "";
		  document.getElementById("reg-indicator").innerHTML = "Password fields can't be empty or passwords dont match.";
		
		}
			

}


function search(something) { // This event fires when a button is clicked
		  
		  	 $.ajax({ // ajax call starts
		      type: "GET",
		          url: 'database/search.php', // JQuery loads serverside.php
		          data: "command=city&search="+something, // Send value of the clicked button
		          dataType: 'json', // Choosing a JSON datatype
		          success: function(data) // Variable data contains the data we get from serverside
		          {
		          	$("#result-page").show();
		          	$("#page1").hide();
		              $('#result').html('');
		              
		              /*
for (var obj in data.Response){
			              //$('#results').append('<li>' + 'Dogs' + '</li>');
			   
			              $('#results').append(
			             
						    '<div class="app-section">' 	+
			                '<p id="house_id">' 			+ data.Response[obj].house_id 			+ '</p>' +
			              	'<p id="HouseRating">' 			+ data.Response[obj].HouseRating 		+ '</p>' +
						  	'<p id="HouseCost">	' 			+ data.Response[obj].HouseCost 		+ '</p>' +
						  	'<p id="HouseComments">' 		+ data.Response[obj].HouseComments 	+ '</p>' +
						  	'<p id="HousePostalCode">' 		+ data.Response[obj].HousePostalCode 	+ '</p>' +
						  	'<p id="HouseProvince">' 		+ data.Response[obj].HouseProvince 	+ '</p>' +
						  	'<p id="HouseCity">'			+ data.Response[obj].HouseCity 		+ '</p>' +
						  	'<p id="HouseStreet">'			+ data.Response[obj].HouseStreet 		+ '</p>' +
						  	'<p id="HouseConvenience">' 	+ data.Response[obj].HouseConvenience 	+ '</p>' +
						  	'<p id="HousePicture">'			+ data.Response[obj].HousePicture 		+ '</p>' +
						  	'<p id="HouseType">'			+ data.Response[obj].HouseType 		+ '</p>' +
						  	'<p id="HouseCapacity">' 		+ data.Response[obj].HouseCapacity 	+ '</p>' +
						  	'<p id="HouseDateAdded">' 		+ data.Response[obj].HouseDateAdded 	+ '</p>' 
			              
						  	+ '</div>' );
						  							  
			             // $('#results').append('<li>' + 'Dogs' + '</li>');
			             
				  	
		              }
*/
						for (var obj in data.Response){
			              //$('#results').append('<li>' + 'Dogs' + '</li>');
			              
			              //alert(data.Response[obj].HousePicture);
			              //data.Response[obj].HousePicture +
			   
			              $('#result').append(
			              
			              '<div align="center">' 	+
			             
									'<table bgcolor="#2c3e50" width="50%" >' +
									    '<tr>' +
									        '<th colspan="15">' +'House id: ' + data.Response[obj].house_id  + '</th>' +
									        
									    '</tr>' +
									    '<tr>' +
									        '<td colspan="15">'+ '</br></br>' +  '<div align="center"><img border="0" align="center" src="images/Beta_Testing.jpg" alt="Pulpit rock" width="304" height="228"></div>' + '</br></br>'+'</td>' +
									    '</tr>' +
									    
									    '<tr>' +
									        '<td>' + 'Rating: ' + data.Response[obj].HouseRating + '</td>' +
									        '<td>'  + 'Capacity: ' + data.Response[obj].HouseCapacity + '</td>' +
									        '<td>' + 'Cost per month: ' + '$'+data.Response[obj].HouseCost + '</td>' +
									    '</tr>' +
									    
									    '<tr>' +
									        '<td>HouseType</td>'+
									        '<td colspan="15"> contact</td>' +
									    '</tr>' +
									    '<tr>' +
									        '<td colspan="15" align="center">' + '</br>Comments: </br></br>' + data.Response[obj].HouseComments +'</br></br>'	+ '</td>' +
									    '</tr>' +
									    
									    '<tr>' +
									        '<td>Postal Code:</td>' +
									        '<td colspan="15">' 	+  data.Response[obj].HousePostalCode 	+ '</td>' +
									    '</tr>' +
									    '<tr>' +
									        '<td>Province:</td>' +
									       ' <td colspan="15">' 		+ data.Response[obj].HouseProvince 	+ '</td>' +
									    '</tr>' +
									    '<tr>'+
									       ' <td>Street:</td>' +
									       ' <td colspan="15">'			+ data.Response[obj].HouseStreet 		+ '</td>' +
									   ' </tr>' +
									    '<tr>' +
									        '<td>City:</td>' +
									       ' <td colspan="15">'			+ data.Response[obj].HouseCity 		+ '</td>' +
									    '</tr>' +
									    
									'</table>'
			              
			              + '</div>' + '</br></br>');
						  							  
			             // $('#results').append('<li>' + 'Dogs' + '</li>');
			             
				  	
		              }
					  
		             
		          }
		      });

}

