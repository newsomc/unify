<?php

class db{ 
 private static $pdo = NULL;
 private static $singleton = NULL;	
 private static $username  = "root";
 //private static $password = "bigsur2526";
 private static $dsn= "mysql:host=localhost;dbname=bulletin";

 private function __construct() {
  self::$pdo = new PDO(self::$dsn, self::$username, $GLOBALS['db-pass']);
  self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }

 public static function getInstance() {
   if (!self::$singleton){
     self::$singleton = new db();
   }
   return self::$singleton;
 }
 
 public function insertDepartment($deptCode, $deptName) {
    if (strlen($deptCode) != 4 || is_numeric($deptCode)){
      die("Department code must be non numeric and four characters long.");
    }
    $exc = self::$pdo->prepare("INSERT INTO AcademicDepartments VALUES(?,?)");
    try{
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$pdo->beginTransaction();
      $exc->execute( array($deptCode, $deptName));
      self::$pdo->commit();
      echo "The Department, " . $deptName . " and code, " . $deptCode . " have been added to UNIFY. Thank You."; 
    }catch(PDOException $e){
      self::$pdo->rollback();
      echo "Error:" . $e->getMessage() . "<br/>";
    }
  }

  public function addUser($uni, $departmentCode, $accessLevel, $userName){
    try{
      if(isset($uni) && isset($departmentCode) && isset($accessLevel) && isset($userName)){ 
        $exc = self::$pdo->prepare("INSERT INTO Security VALUES (?,?,?,?)");
        self::$pdo->beginTransaction();
        $exc->execute(array($uni, $departmentCode, $accessLevel, $userName));
        self::$pdo->commit();
      }else{
	echo "No fields can be left null!";
      }
    }catch(PDOException $e){
      self::$pdo->rollback();
      echo "Error:" . $e->getMessage() . "<br/>";
    }
   }

  public function addSubject($subjectCode, $subjectName){
    if (isset($subjectCode) && isset($subjectName)){
      $exc = self::$pdo->prepare("INSERT INTO Subjects VALUES (?,?)");
      self::$pdo->beginTransaction();
      $exc->execute(array($subjectCode, $subjectName));
      self::$pdo->commit();
      echo ("The subject, ". $subjectName . " has been added to UNIFY."); 
    }else{
      echo "Error" . $e->getMessage() . "<br/>";
    }
  } 

  public function getDepartmentCodes(){
	//var_dump(get_class_methods(self::$pdo)); 
    $exc = self::$pdo->prepare("SELECT DISTINCT Academic_Department_Code 
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

  public function getPrivLevels(){
    $exc = self::$pdo->prepare("SELECT DISTINCT Privilege_Level 
	 							FROM Security ORDER BY Privilege_Level");
    $exc->execute();
    $pL = $exc->fetchAll();
    $privLevels = array();
    foreach($pL as $privs){
      $privLevels[] = $privs["Privilege_Level"] . "\n";
    }
    return $privs = array("Privs" => $privLevels);
  }

  public function insertNewSectionHeading($academicDept, $headingSchool, $headingOrder, $headingName, $created, $updated_by, $created_by){
    $exc = self::$pdo->prepare("INSERT INTO SectionHeadings (
                                       Academic_Department_Code, 
                                       Section_Heading_School,  
                                       Section_Heading_Order, 
                                       Section_Heading_Name, 
                                       Created, Updated, 
                                       Updated_By, Created_By) VALUES ( ?,?,?,?,NOW(),NOW(),?,?");
    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    self::$pdo->beginTransaction();
    $exc->execute(array($acedemicDept, $headingSchool, $headingOrder, $headingName, $created, $updated_by, $created_by));
    self::$pdo->commit();
  }

  public function selectSecuritySettings($uni){
    if(!is_string($uni)){
      throw new Exception("Uni must be a string");
    }
    $exc = self::$pdo->prepare("SELECT * FROM Security s 
                                     LEFT JOIN AcademicDepartments ad 
                                     ON s.Affiliation=ad.Academic_Department_Code  
                                     WHERE User_ID = ?");
    var_dump($exc);  
    $exc->execute(array($uni));
    $dS = $exc->fetchAll();
    //var_dump($dS);
    $userSettings = array();
    foreach ($dS as $settings){
      $userSettings[] = $settings;
    } 
    $userSettings = array("User_Settings" => $userSettings);
    print_r($userSettings);
  }

}

?>
