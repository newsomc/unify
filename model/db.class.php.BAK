<?php

class db {
  
  private  $connection;
  private  $username  = "root";
  private  $password = "bigsur2526";
  private  $dsn= "mysql:host=localhost;dbname=bulletin";

  public function __construct(){
    $this->connect();
    
  }

  public function connect(){
    try{
      $this->connection = new PDO( $this->dsn, $this->username, $this->password);
	  //$this->connection = new PDO( $this->dsn, $this->username, $this->password);
      //echo ("Connected to DB!\n");
    }
    catch (PDOException $e){
      //echo ("problems \n");
      echo 'Connection failed: ' .$e->getMessage();
    }
  }

  public function insertDepartment($deptCode, $deptName) {
    if (strlen($deptCode) != 4 || is_numeric($deptCode)){
      die("Department code must be non numeric and four characters long.");
    }
    $exc = $this->connection->prepare("INSERT INTO AcademicDepartments VALUES(?,?)");
    try{
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->connection->beginTransaction();
      $exc->execute( array($deptCode, $deptName));
      $this->connection->commit();
      echo "The Department, " . $deptName . " and code, " . $deptCode . " have been added to UNIFY. Thank You."; 
    }catch(PDOException $e){
      $this->connection->rollback();
      echo "Error:" . $e->getMessage() . "<br/>";
    }
  }

  public function addUser($uni, $departmentCode, $accessLevel, $userName){
    try{
      if(isset($uni) && isset($departmentCode) && isset($accessLevel) && isset($userName)){ 
        $exc = $this->connection->prepare("INSERT INTO Security VALUES (?,?,?,?)");
        $this->connection->beginTransaction();
        $exc->execute(array($uni, $departmentCode, $accessLevel, $userName));
        $this->connection->commit();
        echo ("The user ".$userName." has been added to UNIFY.");
      }else{
	echo "No fields can be left null!";
      }
    }catch(PDOException $e){
      $this->connection->rollback();
      echo "Error:" . $e->getMessage() . "<br/>";
    }
   }

  public function addSubject($subjectCode, $subjectName){
    if (isset($subjectCode) && isset($subjectName)){
      $exc = $this->connection->prepare("INSERT INTO Subjects VALUES (?,?)");
      $this->connection->beginTransaction();
      $exc->execute(array($subjectCode, $subjectName));
      $this->connection->commit();
      echo ("The subject, ". $subjectName . " has been added to UNIFY."); 
    }else{
      echo "Error" . $e->getMessage() . "<br/>";
    }
  } 

  public function getDepartmentCodes(){
    $exc = $this->connection->prepare("SELECT DISTINCT Academic_Department_Code 
                                       FROM AcademicDepartmentsSubjects");
    $exc->execute();
    $dC = $exc->fetchAll();
    $departmentCodes = array();
    foreach($dC as $codes){
      $departmentCodes[] = $codes["Academic_Department_Code"] . "\n";
    }
    $departmentCodes = array("Academic_Department_Codes" => $departmentCodes);
    return json_encode($departmentCodes);
  }

  public function insertNewSectionHeading($academicDept, $headingSchool, $headingOrder, $headingName, $created, $updated_by, $created_by){
    $exc = $this->connection->prepare("INSERT INTO SectionHeadings (
                                       Academic_Department_Code, 
                                       Section_Heading_School,  
                                       Section_Heading_Order, 
                                       Section_Heading_Name, 
                                       Created, Updated, 
                                       Updated_By, Created_By) VALUES ( ?,?,?,?,NOW(),NOW(),?,?");
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->connection->beginTransaction();
    $exc->execute(array($acedemicDept, $headingSchool, $headingOrder, $headingName, $created, $updated_by, $created_by));
    $this->connection->commit();
  }

  public function selectSecuritySettings($uni){
    if(!is_string($uni)){
      throw new Exception("Uni must be a string");
    }
    $exc = $this->connection->prepare("SELECT * FROM Security s 
                                       LEFT JOIN AcademicDepartments ad 
                                       ON s.Affiliation=ad.Academic_Department_Code  
                                       WHERE User_ID = ?");
    $exc->execute(array($uni));
    $dS = $exc->fetchAll();
    //var_dump($dS);
    $userSettings = array();
    foreach ($dS as $settings){
      $userSettings[] = $settings;
    } 
    $userSettings = array("User_Settings" => $userSettings);
    //print_r($userSettings);
  }

}//Close UNIFY class.

//$unify = new Unify();
//$unify->selectSecuritySettings("cc3107");

?>