<?php
require_once('views/_base.php');
require_once('includes/init.php');

Class formController Extends baseController {

 public function index(){
   $this->registry->template->form_heading = 'This is the form Index';
   $this->registry->template->show('form_index');
 }

 public function view(){
	/*** should not have to call this here.... FIX ME ***/
   $this->registry->template->form_heading = 'This is the form heading';
   $this->registry->template->form_content = 'This is the form content';
   

   
   $db = new db();
   //$this->registry->settings = $db->selectSecuritySettings("cc3107");
   $this->registry->template->set = $db->selectSecuritySettings("cc3107");

   $this->registry->template->footer = writeFooter();
   $this->registry->template->show('form_view');
 }

}
?>
