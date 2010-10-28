<?php 
require_once("_base.php");
writeHead();
?>
<script type="text/javascript">var foo = <?php echo $set;?>;
alert(foo);
</script>

<h1><?php echo $form_heading;?></h1>
<p><?php echo $form_content;?></p>
<p><select id="departmentList"></select></p>
<p><input type="text" name="date" id="date" /></p>
<?php echo $footer;?>