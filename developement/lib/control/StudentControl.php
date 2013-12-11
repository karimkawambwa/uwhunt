<?php
	include_once('../dao/StudentDao.php');
	include_once('../control/NavigationControl.php');
	include_once('../domain/Mail.php');

	class StudentControl{
		public $student ;//student object; new or with actual data
		public $sentRequest;

		public function __construct($_studentObject){
			$this->student = $_studentObject;
		}

		public function studentSignUp($_request){
			/*
			 *We assume validation is complete at this point.
			 *That is, we have check if the email is free, passwords match etc.
			 *All we are doing here is setting up the student object and firing off the StudentDao
			 */
			//consider add the date the student was added.
			$this->sentRequest = $_request;
			$this->student->student_email = $this->sentRequest['studentEmail'];
			$this->student->student_password = $this->sentRequest['enteredPassword'];

			$studentDao = new StudentDao();

			$returnedStudent = $studentDao->registerStudent($this->student);

			if($returnedStudent != null) {
				//$navigationControl = new NavigationControl();
				//$navigationControl->getStudentProfile($returnedStudent);
				
				// send validation email
				
				
				echo json_encode(array('registration' => 'succeeded',
											 'email' => $this->student->student_email));

			} else {
				//return to frontpage with error message
				echo json_encode(array('registration' => 'failed',
											 'email' => $this->student->student_email));
;
			}
			

		}

		public function getStudentById($id){
			$studentDao = new StudentDao();
			$returnedStudent = $studentDao->getStudentByValue("id", $id);
			return $returnedStudent;
		}
	}
?>