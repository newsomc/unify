<script type="text/javascript">
$().ready(function() {                                                                                                                                                                                        
                                                                                                                                                                                                              
	function log(event, data, formatted) {                                                                                                                                                             
	  $("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");                                                                                                          
	}                                                                                                                                                                                                     
                                                                                                                                                                                                    
	function formatItem(row) {                                                                                                                                                                            
	  return row[0] + " (<strong>id: " + row[1] + "</strong>)";                                                                                                                                     
	}                                                                                                                                                                                                     
	function formatResult(row) {                                                                                                                                                                          
	  return row[0].replace(/(<.+?>)/gi, '');                                                                                                                                                       
	}                                                                                                                                                                                                     
	var departments = <?php echo $deptCodes . ";"?>                                                                                                                                                                                                     
	
	$("#DepartmentCodes").focus().autocomplete(departments['Academic_Department_Codes']);                                                                                                                                                          
	$('#addUser').submit(function(){
	    $.post('/form/addUser', {
		    uni: $('#uni').val(),
			fullName: $("#FirstName").val() + " " + $("#LastName").val(),
			securityLevel: $("#SecurityLevel").val(),
			departmentCode: $("#DepartmentCodes").val()
		  }, function(data){
			   alert(data);
		});
		return false; 
		//alert($('#FirstName').val() + $('#LastName').val() + $('#SecurityLevel').val() + $("#departmentCodes").val());
	});

});
</script>

<form id = "addUser" method="post">
  <label for="uni">UNI:</label>
  <input id="uni" type="text"/>	
  <label for="FirstName">First Name:</label>
  <input id="FirstName" type="text"/>
  <label for="LastName">Last Name:</label>
  <input id="LastName" type="text"/>
  <label for="SecurityLevel">Security Level:</label>
  <select id="SecurityLevel">
  <?php
	foreach($privs['Privs'] as $priv){
		echo "<option value='$priv'>$priv</option>";
	}	
  ?>
  </select> 
  <label for="DepartmentCodes">Department Autocomplete:</label>                                                                                                                                                   
  <input type="text" id="DepartmentCodes" />                                                                                                                                                   
  <input type="submit" value="submit!"/>
</form>
</div>
