<?php
require_once('views/_base.php');
require_once('includes/init.php');

Class formController Extends baseController {

 public function index(){
   $this->registry->template->form_heading = 'This is the form Index';
   $this->registry->template->show('form_index');
 }

 public function view(){

   //$this->registry->settings = $db->selectSecuritySettings("cc3107");
   //$this->registry->template->set = $db->selectSecuritySettings("cc3107");
   $this->registry->template->form_heading = 'My Form';
   $this->registry->template->form_content = 'This is the form title';

   $codes = $this->registry->db->getDepartmentCodes();
   $this->registry->template->set = $codes;

   $this->registry->template->footer = writeFooter();
   $this->registry->template->show('form_view');
 }

 public function cool(){
   $this->registry->template->form_heading = 'COOL!';
   $this->registry->template->form_content = 'too cool!';
   $this->registry->template->show('form_cool');
 }
}
?>
