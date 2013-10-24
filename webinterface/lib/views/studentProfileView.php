<?php
	include_once('PageDefaultComponents.php');
	$pageDefaultComponents = new PageDefaultComponents('Hunt');
	$pageDefaultComponents->getComponents();
?>
	
	<div id="page1">
		<div class="">
			<form>
				<?php
					echo '<div><input id="studentEmail" type="text" value="'.$data->student_email.'"> Email</div><br/>'
						 .'<div><input id="studentPassword" type="text" value="'.$data->student_password.'"> Password</div><br/>'
						 .'<div><input id="username" type="text" value="'.$data->username.'"> Username</div><br/>'
						 .'<div><input id="firstName" type="text" value="'.$data->first_name.'"> First Name</div><br/>'
						 .'<div><input id="lastName" type="text" value="'.$data->last_name.'"> Last Name</div>'
						 .'<div><input type="submit" value="Update"/></div>';
				?>
			</form>
		</div>
	</div>
	</body>
</html>