<form id = "addUser">
 <label for="FirstName">First Name:</label>
 <input id="FirstName" type="text"/>
 
 <label for="LastName">Last Name:</label>
 <input id="LastName" type="text"/>
 
 <label for="Uni">UNI:</label>
 <input id="Uni" type="text"/>

 <select id="SecurityLevel">
 <?php
	foreach($privs['Privs'] as $p){
		echo "<option value='$p'>$p</option>";
	}	
 ?>
 </select> 

 <select id="DepartmentCodes">
 <?php
	foreach($deptCodes['Academic_Department_Codes'] as $dCodes){
		echo "<option value='$dCodes'>$dCodes</option>";
	}	
 ?>
 </select>

 <input type="submit" value="submit!"/>
</form>
</div>
