<?php
 
include_once 'database.php';
//$error = ''; 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_staffs_a175432_final(FLD_STAFF_ID, FLD_STAFF_NAME, FLD_STAFF_CONTACT,
      FLD_STAFF_EMAIL, FLD_STAFF_TYPE, FLD_STAFF_PASSWORD) VALUES(:sid, :name, :contact, :email, :type, :password)");
   
    $stmt2 = $conn->prepare("SELECT FLD_STAFF_EMAIL FROM tbl_staffs_a175432_final WHERE FLD_STAFF_EMAIL = :email2");
    $stmt2 ->bindParam(':email2', $_POST['email']);
    $stmt2->execute();
    $stmt2->fetch(PDO::FETCH_ASSOC);
    $check =  $stmt2 ->rowCount();

    if($check > 0){
      echo "<script>alert('Failed to Create')</script>";
      $error = 'Email already exists';
    }else {
    

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':contact', $contact, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email =  $_POST['email'];
    $type =  $_POST['type'];
    $password =  $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);     
    $stmt->execute();
    header('Location: staffs.php');
    }
  }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_staffs_a175432_final SET
      FLD_STAFF_ID = :sid, FLD_STAFF_NAME = :name,
      FLD_STAFF_CONTACT = :contact, FLD_STAFF_EMAIL = :email,
      FLD_STAFF_TYPE = :type, FLD_STAFF_PASSWORD = :password
      WHERE FLD_STAFF_ID = :oldsid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':contact', $contact, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $oldsid = $_POST['oldsid'];
         
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a175432_final where FLD_STAFF_ID = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: staffs.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a175432_final where FLD_STAFF_ID = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
       
    $sid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
 
?>