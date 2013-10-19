<?php
	require('lib/session.class.php');
	require('lib/house.post.class.php');

	$session = new session();
	$post = new HousePost();
	
	// Set to true if using https
	$session->start_session('_s', false);

	
	$command = $_POST['command'];
	
	switch ($command){
		case 'step1'://search by address

			$HouseRating 		= 	$_POST['HouseRating'];
			$HouseCost 			= 	$_POST['HouseCost']; 
			$HouseComments 		= 	$_POST['HouseRating'];
			$HousePostalCode 	= 	$_POST['HouseComments'];
			$HouseProvince 		= 	$_POST['HouseProvince'];
			$HouseCity 			= 	$_POST['HouseCity'];
			$HouseStreet 		= 	$_POST['HouseStreet'];
			$HouseConvenience 	=	$_POST['HouseConvenience'];
			$HouseType          =   $_POST['$HouseType'];
			$HouseCapacity 		= 	$_POST['HouseCapacity'];
			$HouseDateAdded 	=	date('YYYY-MM-DD');

			if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) { 
		        
		        // Temporary file name stored on the server
		        $tmpName  = $_FILES['image']['tmp_name'];  
		       
		        // Read the file 
		        $fp      = fopen($tmpName, 'r');
		        $data = fread($fp, filesize($tmpName));
		        $HousePicturedata = addslashes($data);
		        fclose($fp);

	    	}


	    	$post->step1(  	$HouseRating, 
							$HouseCost,
							$HouseComments,
							$HousePostalCode,
							$HouseProvince,
							$HouseCity,
							$HouseStreet,
							$HouseConvenience,
							$HousePicturedata,
							$HouseType,
							$HouseCapacity,
							$HouseDateAdded 		);

	    	header('Location: http://chataloo.comli.com/');

			break;
		
		case 'step2'://search by city

		 	$OwnerFirstName 		= 	$_POST['OwnerFirstName'];
			$OwnerLastName 			= 	$_POST['OwnerLastName'];
			$OwnerPhoneNumber		= 	$_POST['OwnerPhoneNumber'];
			$OwnerEmail  			= 	$_POST['OwnerEmail'];

			$post->step2(   $OwnerFirstName,	
							$OwnerLastName, 		
							$OwnerPhoneNumber,	
							$OwnerEmail  		);

			header('Location: http://chataloo.comli.com/');

			break;
		
		case 'step3'://search by work
			
			$OwnerFirstName 		= 	$_POST['WorkplaceName'];
			$OwnerLastName 			= 	$_POST['WorplaceCity'];
			$OwnerPhoneNumber		= 	$_POST['WorplaceProvince'];
			$OwnerEmail  			= 	$_POST['WorkplaceAddress'];

			$post->step3(   $OwnerFirstName,	
							$OwnerLastName, 		
							$OwnerPhoneNumber,	
							$OwnerEmail  		);

			header('Location: http://chataloo.comli.com/');
			
			break;
		
	}


	
?>