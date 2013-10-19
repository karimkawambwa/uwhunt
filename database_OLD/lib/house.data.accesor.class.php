<?php
	include_once 'HouseDatabase.php';
	
	class Search extends HouseDatabase{
		public function __construct(){
			parent::__construct();
			}
				
				public function gethousebyworkplace($workplace){

					//open connection
					$this->openConnection();
					$dbConnection = $this->_connection;
					
					try{
						$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $dbConnection->prepare('SELECT * FROM Workplace WHERE WorkPlaceName LIKE ?');
						$stmt1 = $dbConnection->prepare('SELECT * FROM HouseDetail WHERE house_id = :id');
						
						$stmt -> execute(array( $workplace ) );

						$result = $stmt->fetchAll();
						if($stmt->rowCount() > 0){

							foreach ($result as $_result) {

								$stmt1 -> execute(array( ':id' => $_result['house_id'] ) );

							}

							return false;
						} else {
							return true;
						}
											
					} catch(PDOException $e){
						echo 'ERROR SEARCHING HOUSE BY WORKPLACE: ' . $e->getMessage();
						}
				}

				public function gethousebyaddress($address){
										//open connection
					$this->openConnection();
					$dbConnection = $this->_connection;
					
					try{
						$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $dbConnection->prepare('SELECT * FROM Workplace WHERE WorkPlaceName LIKE ?');
						$stmt1 = $dbConnection->prepare('SELECT * FROM HouseDetail WHERE house_id = :id');
						
						$stmt -> execute(array( $address ) );

						$result = $stmt->fetchAll();
						if($stmt->rowCount() > 0){

							foreach ($result as $_result) {

								$stmt1 -> execute(array( ':id' => $_result['house_id'] ) );

							}

							return false;
						} else {
							return true;
						}
											
					} catch(PDOException $e){
						echo 'ERROR SEARCHING HOUSE BY ADDRESS: ' . $e->getMessage();
						}
				}

				public function gethousebycity($city){
										//open connection
					$this->openConnection();
					$dbConnection = $this->_connection;
					
					try{
						$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $dbConnection->prepare('SELECT * FROM HouseDetail WHERE HouseCity LIKE ? ');
						
						$stmt -> execute(array( '%'.$city.'%' ) );

						$result = $stmt->fetchAll();

						if($stmt->rowCount() > 0){

							$Houses;
							$found = 0;

							foreach ($result as $_result) {
							
								$base64 = base64_encode($_result['HousePicture']);

								$House['house_id'] = $_result['house_id'];
								$House['HouseRating'] = $_result['HouseRating'];
								$House['HouseCost'] = $_result['HouseCost'];
								$House['HouseComments'] = $_result['HouseComments'];
								$House['HousePostalCode'] = $_result['HousePostalCode'];
								$House['HouseProvince'] = $_result['HouseProvince'];
								$House['HouseCity'] = $_result['HouseCity'];
								$House['HouseStreet'] = $_result['HouseStreet'];
								$House['HouseConvenience'] = $_result['HouseConvenience'];
								$House['HousePicture'] = "<img src='data:image/jpeg;base64," .stripslashes ( $base64 ) . "' alt='name' >"; //base64_encode($_result['HousePicture'])
								$House['HousePicName'] = $_result['HousePicName'];
								$House['HousePicType'] = $_result['HousePicType'];
								$House['HousePicSize'] = $_result['HousePicSize'];
								$House['HouseType'] = $_result['HouseType'];
								$House['HouseCapacity'] = $_result['HouseCapacity'];
								$House['HouseDateAdded'] = $_result['HouseDateAdded'];

								$Houses[$found] = $House;
								$found += 1;
								
							}

							$Response['Response'] = $Houses;
							
							echo json_encode($Response);
							
						} else {
							echo 'no result';
						}
											
					} catch(PDOException $e){
						echo 'ERROR SEARCHING HOUSE BY CITY: ' . $e->getMessage();
						}
				}
	}
?>