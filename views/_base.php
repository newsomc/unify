<?php
function writeHead() {
?>
        <!DOCTYPE html>
        <html>
        <head>
           <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	       <title><?php echo "title" ?></title>
	       <link rel="stylesheet" type="text/css" media="screen" href="<?=$GLOBALS['urlpath'] ?>/css/shared.css" />
	       <link rel="stylesheet" type="text/css" media="screen" href="<?=$GLOBALS['urlpath'] ?>/user_interface/jquery-ui-1/css/ui-lightness/third_party/jquery-ui-1.8.5.custom.css" />
	       <link rel="stylesheet" type="text/css" media="screen" href="<?=$GLOBALS['urlpath'] ?>/css/third_party/jquery.flexbox.css" />
	       <script type="text/javascript" src="<?=$_SERVER['SERVER_NAME']?>/user_interface/js/jquery-1.4.2.min.js"></script>
	       <script type="text/javascript" src="<?=$_SERVER['SERVER_NAME']?>/user_interface/jquery-ui-1.8.5.custom.min.js"></script>
	       <script type="text/javascript" src="<?=$_SERVER['SERVER_NAME']?>/user_interface/jquery.flexbox.js"></script>
	       <script type="text/javascript" src="<?=$_SERVER['SERVER_NAME']?>/user_interface/jquery.tablesorter.min.js"></script>
	       <script type="text/javascript" src="<?=$_SERVER['SERVER_NAME']?>/user_interface/base64.js"></script>
	       <script type="text/javascript" src="<?=$_SERVER['SERVER_NAME']?>/user_interface/utf8.js"></script>
	       <script type="text/javascript" src="<?=$_SERVER['SERVER_NAME']?>/user_interface/aes.js"></script>
	       <script type="text/javascript" src="<?=$_SERVER['SERVER_NAME']?>/user_interface/aes-ctr.js"></script>
	       <script type="text/javascript" src="<?=$_SERVER['SERVER_NAME']?>/static/js/utility.js"></script>
	       <script type="text/javascript" src="<?=$_SERVER['SERVER_NAME']?>/static/js/shared.js"></script>
        </head>
    	<body>
<?php
}
        
function writeFooter() {
?>

        </body>
    </html>
<?php
    }
?>