<?php
require_once('includes/init.php');

Class formController Extends baseController {

 private $uni;
 private $fullName;
 private $securityLevel;
 private $departmentCode;

 public function __construct($registry){
	parent::__construct($registry);
	if(!isset($_POST['uni']))
		$_POST['uni	'] = '';
	if(!isset($_POST['fullName']))
		$_POST['fullName'] = '';
	if(!isset($_POST['securityLevel']))
		$_POST['securityLevel'] = '';
	if(!isset($_POST['departmentCode']))
		$_POST['departmentCode'] = '';

	$this->fullName = $_POST['fullName'];
	$this->secuityLevel = $_POST['securityLevel'];
    $this->departmentCode = $_POST['departmentCode'];
 }

/*
 public function __construct(){

 } */

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

 public function addUser($input){
	
   $this->registry->db->addUser($input['uni'], $input['departmentCode'], $input['securityLevel'], $input['fullName']);
   echo $input['fullName'] . " added to DB! With the security level of " . $input['securityLevel'] . " and department code, " . $input['departmentCode'];		
	
 }

}
?>
