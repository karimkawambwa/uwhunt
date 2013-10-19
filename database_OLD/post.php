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
		        echo "received";
		        // Temporary file name stored on the server
		        $tmpName  = $_FILES['image']['tmp_name'];  
		        $HousePicName = $_FILES['image']['name'];
		        $HousePicType = $_FILES['image']['type'];	
		        $HousePicSize = $_FILES["image"]["size"];
		       
		        // Read the file 
		        $fp      = fopen($tmpName, 'r');
		        $data = fread($fp, filesize($tmpName));
		        $HousePicturedata = $data; //addslashes($data);
		        fclose($fp);

	    	}else{		
			  switch($_FILES['image']['error']){
				case 0: //no error; possible file attack!
				  echo "There was a problem with your upload.";
				  break;
				case 1: //uploaded file exceeds the upload_max_filesize directive in php.ini
				  echo "The file you are trying to upload is too big.";
				  break;
				case 2: //uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form
				  echo "The file you are trying to upload is too big.";
				  break;
				case 3: //uploaded file was only partially uploaded
				  echo "The file you are trying upload was only partially uploaded.";
				  break;
				case 4: //no file was uploaded
				  echo "You must select an image for upload.";
				  break;
				default: //a default error, just in case! 
				  echo "There was a problem with your upload.";
				  break;
	
 					 }		
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
							$HousePicName,
							$HousePicType,
							$HousePicSize,
							$HouseType,
							$HouseCapacity,
							$HouseDateAdded 		);

	    	//header('Location: http://chataloo.comli.com/');
	    	echo 'step 1 done';

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
							
			echo 'step 2 done';

			//header('Location: http://chataloo.comli.com/');

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
			
			echo 'step 3 done';
			
			//header('Location: http://chataloo.comli.com/');
			
			break;
		
	}


	
?>