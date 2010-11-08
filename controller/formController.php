<?php
require_once('includes/init.php');

Class formController Extends baseController {

 private $firstName;
 private $lastName;

 public function __construct(){
   if (isset($_POST['firstName']) && isset($_POST['lastName'])){
     $this->firstName = $_POST['firstName'];
     $this->lastName = $_POST['lastName'];	
   }
 } 

 public function index(){
   $this->registry->template->form_heading = 'This is the form Index';
   $this->registry->template->show('form_index');
 }

 public function view(){

   $this->registry->template->form_heading = 'My Form';
   $this->registry->template->form_content = 'This is the form title';

   $codes = $this->registry->db->getDepartmentCodes();
   $this->registry->template->set = $codes;

   $this->registry->template->footer = writeFooter();
   $this->registry->template->show('form_view');
 }

 public function add(){
   
   $javascript_array = array(
			'form_view.js'
   );
   $css_array = array(
			'some_css.css',
			'another_css.css'
   );
   $this->registry->template->writeHead($javascript_array, $css_array); 
 
   $privs = $this->registry->db->getPrivLevels();
   $this->registry->template->privs = $privs;
  
   $deptCodes = $this->registry->db->getDepartmentCodes();
   $this->registry->template->deptCodes = $deptCodes;

   $this->registry->template->show('form_add');	 
   $this->registry->template->writeFooter(); 
  
  }

 public function addUser($firstName, $lastName){

   echo $firstName ." " . $lastName . " added to DB!";		
	
 }

}
?>
