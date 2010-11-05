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
        $("#departmentCodes").focus().autocomplete(departments['Academic_Department_Codes']);                                                                                                                                                          
       
		$('#addUser').submit(function(){
			$.post('form_add.php', {
			   firstName: $('#FirstName').val(),
			   lastName: $('#LastName').val(),
			   securityLevel: $('#SecurityLevel').val(),
			   deptartmentCodes: $("#departmentCodes").val()
			}, function(data) {
			    alert(data.firstName);
			});
		});
		
});
</script>

<form id = "addUser" method="post">
  <label for="FirstName">First Name:</label>
  <input id="FirstName" type="text"/>
 
  <label for="LastName">Last Name:</label>
  <input id="LastName" type="text"/>

  <select id="SecurityLevel">
  <?php
	foreach($privs['Privs'] as $p){
		echo "<option value='$p'>$p</option>";
	}	
  ?>
  </select> 

  <label>Department Autocomplete:</label>                                                                                                                                                   
  <input type="text" id="departmentCodes" />                                                                                                                                                   
  <input type="submit" value="submit!"/>
</form>
</div>
