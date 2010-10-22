<?php

class db{

 private static $instance = NULL;
 private  $username  = "root";
 private  $password = "bigsur2526";
 private  $dsn= "mysql:host=localhost;dbname=bulletin";
 
 private function __construct() {
  /*** maybe set the db name here later ***/
 }

 public static function getInstance() {
   if (!self::$instance){
     self::$instance = PDO( $this->dsn, $this->username, $this->password);
     self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
 return self::$instance;
 }
 
 private function __clone(){
 } 
 public function insertDepartment($deptCode, $deptName) {
    if (strlen($deptCode) != 4 || is_numeric($deptCode)){
      die("Department code must be non numeric and four characters long.");
    }
    $exc = self::$instance->prepare("INSERT INTO AcademicDepartments VALUES(?,?)");
    try{
      self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$instance->beginTransaction();
      $exc->execute( array($deptCode, $deptName));
      self::$instance->commit();
      echo "The Department, " . $deptName . " and code, " . $deptCode . " have been added to UNIFY. Thank You."; 
    }catch(PDOException $e){
      self::$instance->rollback();
      echo "Error:" . $e->getMessage() . "<br/>";
    }
  }

  public function addUser($uni, $departmentCode, $accessLevel, $userName){
    try{
      if(isset($uni) && isset($departmentCode) && isset($accessLevel) && isset($userName)){ 
        $exc = self::$instance->prepare("INSERT INTO Security VALUES (?,?,?,?)");
        self::$instance->beginTransaction();
        $exc->execute(array($uni, $departmentCode, $accessLevel, $userName));
        self::$instance->commit();
        echo ("The user ".$userName." has been added to UNIFY.");
      }else{
	echo "No fields can be left null!";
      }
    }catch(PDOException $e){
      self::$instance->rollback();
      echo "Error:" . $e->getMessage() . "<br/>";
    }
   }

  public function addSubject($subjectCode, $subjectName){
    if (isset($subjectCode) && isset($subjectName)){
      $exc = self::$instance->prepare("INSERT INTO Subjects VALUES (?,?)");
      self::$instance->beginTransaction();
      $exc->execute(array($subjectCode, $subjectName));
      self::$instance->commit();
      echo ("The subject, ". $subjectName . " has been added to UNIFY."); 
    }else{
      echo "Error" . $e->getMessage() . "<br/>";
    }
  } 

  public function getDepartmentCodes(){
    $exc = self::$instance->prepare("SELECT DISTINCT Academic_Department_Code 
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
    $exc = self::$instance->prepare("INSERT INTO SectionHeadings (
                                       Academic_Department_Code, 
                                       Section_Heading_School,  
                                       Section_Heading_Order, 
                                       Section_Heading_Name, 
                                       Created, Updated, 
                                       Updated_By, Created_By) VALUES ( ?,?,?,?,NOW(),NOW(),?,?");
    self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    self::$instance->beginTransaction();
    $exc->execute(array($acedemicDept, $headingSchool, $headingOrder, $headingName, $created, $updated_by, $created_by));
    self::$instance->commit();
  }

  public function selectSecuritySettings($uni){
    if(!is_string($uni)){
      throw new Exception("Uni must be a string");
    }
    $exc = self::$instance->prepare("SELECT * FROM Security s 
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



} 
?>
