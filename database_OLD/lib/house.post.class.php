<?php
	include_once 'HouseDatabase.php';
	
	class HousePost extends HouseDatabase{
		
		public function __construct(){
			parent::__construct();
			}


				public function step1(  $HouseRating, 
										$HouseCost,
										$HouseComments,
										$HousePostalCode,
										$HouseProvince,
										$HouseCity,
										$HouseStreet,
										$HouseConvenience,
										$HousePicture,
										$HousePicName,
										$HousePicType,
										$HousePicSize,
										$HouseType,
										$HouseCapacity,
										$HouseDateAdded 		){
					
					//open connection
					$this->openConnection();
					$dbConnection = $this->_connection;
					
					try{
						$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $dbConnection->prepare ("INSERT INTO HouseDetail 
						(house_id, HouseRating, HouseCost, HouseComments, HousePostalCode, HouseProvince, HouseCity, 
						HouseStreet, HouseConvenience, HousePicture, HousePicName, HousePicType, HousePicSize, HouseType,
						 HouseCapacity, HouseDateAdded) 
						VALUES (:id, :HR, :HC, :HCm, :HPC, :HP, :HCt, :HS, :HCv, :HPic, :HPn, 
								:HPt, :HPs, :HT, :HCp, :HD)");
						
						//$_stmt = $dbConnection->prepare('SELECT * FROM HouseDetail WHERE Username LIKE ?');
						//$_stmt = $dbConnection->prepare("SELECT LAST_INSERT_ID() FROM HouseDetail");

						$uid =  uniqid();
					
						$stmt->execute(array(       		':id' 	=>		$uid,
															':HR'	=>		$HouseRating,
															':HC'	=>		$HouseCost,
															':HCm'	=>		$HouseComments,
															':HPC'	=>		$HousePostalCode,
															':HP'	=>		$HouseProvince,
															':HCt'	=>		$HouseCity,
															':HS'   =>		$HouseStreet,
															':HCv'	=>		$HouseConvenience,
															':HPic'	=>		$HousePicture,
															':HPn'	=>		$HousePicName,
															':HPt'   =>		$HousePicType,
															':HPs'	=>		$HousePicSize,
															':HT'	=> 		$HouseType,
															':HCp'	=> 		$HouseCapacity,
															':HD'	=> 		$HouseDateAdded 			));
						
						// $_stmt->execute(array());
						// $result = $_stmt->fetchAll();
						$_SESSION['UID'] = $uid;
						
					}catch(PDOException $e){
						echo 'ERROR Step1: ' . $e->getMessage();
						}
				}

				public function step2(  $OwnerFirstName,
										$OwnerLastName,
										$OwnerPhoneNumber,
										$OwnerEmail          ){
					
					//open connection
					$this->openConnection();
					$dbConnection = $this->_connection;
					
					try{
						$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $dbConnection->prepare ("INSERT INTO Owner 
						(house_id, OwnerFirstName, OwnerLastName, OwnerPhoneNumber, OwnerEmail) 
						VALUES ( :id, :Oname, :Olname, :Ophone, :Oemail )");
						
						//$_stmt = $dbConnection->prepare('SELECT * FROM User WHERE Username LIKE ?');
					
						$stmt->execute(array(	':id'	=>		$_SESSION['UID'],
												':Oname'	=>		$OwnerFirstName,
												':Olname'	=>		$OwnerLastName,
												':Ophone'	=>		$OwnerPhoneNumber,
												':Oemail'	=>		$OwnerEmail     		));
						
						//$_stmt->execute(array( $username ));
						//$result = $_stmt->fetchAll();
						
					}catch(PDOException $e){
						echo 'ERROR: ' . $e->getMessage();
						}
				}

				public function step3(	$WorkplaceName,
										$WorplaceCity,
										$WorplaceProvince,
										$WorkplaceAddress     ){
					
					//open connection
					$this->openConnection();
					$dbConnection = $this->_connection;
					
					try{
						$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $dbConnection->prepare ("INSERT INTO Workplace 
						(house_id, WorkplaceName, WorplaceCity, WorplaceProvince, WorkplaceAddress ) 
						VALUES (:id, :Wname, :Wcity, :Wprov, :Waddress ) ");
						
						//$_stmt = $dbConnection->prepare('SELECT * FROM User WHERE Username LIKE ?');
					
						$stmt->execute(array(	':id'		=>		$_SESSION['UID'],
												':Wname'	=>		$WorkplaceName,
												':Wcity'	=>		$WorplaceCity,
												':Wprov'	=>		$WorplaceProvince,
												':Waddress'	=>		$WorkplaceAddress     		));
						
						
						//$_stmt->execute(array( $username ));
						//$result = $_stmt->fetchAll();
						
					}catch(PDOException $e){
						echo 'ERROR: ' . $e->getMessage();
						}
				}
		}
?>