<?php
class router {
	
 private $registry;
 private $path;
 private $args = array();
 public $file;
 public $controller;
 public $action; 

 function __construct($registry) {
   $this->registry = $registry;
 }

 function setPath($path) {
   if (is_dir($path) == false){
     throw new Exception ('Invalid controller path: `' . $path . '`');
	}
	$this->path = $path;
 }

 public function loader(){
   $this->getController();
   if (is_readable($this->file) == false){
     $this->file = $this->path.'/error404.php';
                $this->controller = 'error404';
	}
	/*** include the controller ***/
	include $this->file;
	
	/*** a new controller class instance ***/
	$class = $this->controller . 'Controller';
	$controller = new $class($this->registry);

	/*** check if the action is callable ***/
	if (is_callable(array($controller, $this->action)) == false){
	  $action = 'index';
	}
	else{
	  $action = $this->action;
	}
	/*** run the action ***/
	/*	In the future let's create a class that sanitizes all of our user input. 
	    Let's not save it til too far into the future though :). 
	    $shield = new Shield($_GET, $_POST);
        $controller->$action($shield->getGet(), $shield->getPost());
   
   */
	$controller->$action($_POST);
 }

 private function getController() {

	/*** get the route from the url ***/
	$route = (empty($_GET['rt'])) ? '' : $_GET['rt'];

	if (empty($route)){
	  $route = 'index';
	}
	else{
	  /*** get the parts of the route ***/
	  $parts = explode('/', $route);
	  $this->controller = $parts[0];
	  if(isset( $parts[1])){
	    $this->action = $parts[1];
	  }
	}

	if (empty($this->controller)){
	  $this->controller = 'index';
	}

	/*** Get action ***/
	if (empty($this->action)){
		$this->action = 'index';
	}

	/*** set the file path ***/
	$this->file = $this->path .'/'. $this->controller . 'Controller.php';
 }

}

?>
