<?php

Class Template {

 private $registry;
 private $vars = array();
 
 function __construct($registry){
   $this->registry = $registry;
 }

 public function __set($index, $value){
   $this->vars[$index] = $value;
 }

 function show($name){
   $path = __SITE_PATH . '/views' . '/' . $name . '.php';
   if (file_exists($path) == false){
     throw new Exception('Template not found in '. $path);
	 return false;
   }
   
   foreach ($this->vars as $key => $value){
     $$key = $value;
	 
   }
   include ($path);               
 }

 function writeHead($javascript_array, $css_array) {
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src=<?="'".$GLOBALS['root-directory'];?>/unify/user_interface/jquery-ui-1/js/jquery-1.4.2.min.js<?="'"?>></script> 
    <script type="text/javascript" src=<?="'".$GLOBALS['root-directory'];?>/unify/user_interface/jquery-ui-1/js/jquery-ui-1.8.5.custom.min.js<?="'"?>></script> 
    <script type="text/javascript" src=<?="'".$GLOBALS['root-directory'];?>/unify/user_interface/jquery-autocomplete/jquery.autocomplete.js<?="'"?>></script> 

<?php
		
  foreach((array) $javascript_array as $key=>$value){
	?><script type="text/javascript" src=<?="'".$GLOBALS['root-directory'];?>/unify/user_interface/custom/<?=$value ."'"?>></script> <?php
   }	
?>	
   <link href='http://10.0.1.9/~hcnewsom/unify/user_interface/jquery-autocomplete/jquery.autocomplete.css' type='text/css' rel='stylesheet'>

<?php
  foreach ((array)$css_array as $key=>$value){
		?><link href=<?="'".$GLOBALS['root-directory'];?>/unify/user_interface/css/<?=$value ."'"?> type='text/css' media='screen' /> <?php
	}

?>
 		</head>
   	<body>
<?php
 }

 function writeFooter(){
	?>
		</body>
	</html>
	<?php
 }

 function writeHeadControls(){
	?>
		<div id="HeadContainer">
			<div id="BrandContainer">
			</div>
			<div id="MainMenu">
				<div class="Button"><div>
				<div class="Button"><div>
				<div class="Button"><div>
				<div class="Button"><div>
			</div>
		</div>
	<?php
 }



	
}
?>
	