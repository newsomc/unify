<?php
function writeHead($javascript_array, $css_array) {
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="http://10.0.1.9/~hcnewsom/unify/user_interface/jquery-ui-1/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="http://10.0.1.9/~hcnewsom/unify/user_interface/jquery-ui-1/js/jquery-ui-1.8.5.custom.min.js"></script>
<?php
		
  foreach((array)$javascript_array as $key=>$value){
	?><script type="text/javascript" src=<?="'".$GLOBALS['root-directory'];?>/unify/user_interface/custom/<?=$value ."'"?>></script> <?php
  }	
		
		if($css_array){
			foreach($css_array as $key=>$value){
				?><link href=<?="'".$GLOBALS['root-directory'];?>/unify/user_interface/css/<?=$value ."'"?> type='text/css' media='screen' /> <?php
			}
		}
?>
 		<head/>
   	<body>
<?php
 }

  function writeFooter() {
?>

        </body>
    </html>
<?php
 }