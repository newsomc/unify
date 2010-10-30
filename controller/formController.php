<?php
require_once('includes/init.php');

Class formController Extends baseController {

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
   $privs = $this->registry->db->getPrivLevels();
   $javascript_array = array(
		'some_js.js' ,
		'another_js.js'
	);
	$css_array = array(
		'some_css.css',
		'another_css.css'
	);
   $this->registry->template->writeHead($javascript_array, $css_array); 
   $this->registry->template->privs = $privs;
   $this->registry->template->writeFooter(); 
   $this->registry->template->show('form_add');
 	
  }
}
?>
