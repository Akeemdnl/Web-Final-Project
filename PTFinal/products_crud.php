<?php
 
include_once 'database.php';
$error = '';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a175432_final(FLD_PRODUCT_ID,
        FLD_PRODUCT_NAME, FLD_PRICE, FLD_BRAND, FLD_TYPE,
        FLD_QUANTITY, FLD_DESCRIPTION, FLD_IMAGE) VALUES(:pid, :name, :price, :brand,
        :type, :quantity, :description, :image)");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_STR);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
      $stmt->bindParam(':image', $image, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    //$image = $_POST['imageUpload'];

    //image uploading
    $target_dir = "products/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      //echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
     // echo "<label id='error' for='quantity' class='col-sm-3 control-label'></label>";
      $error = 'File is not an image';
      $uploadOk = 0;
      //die("Error: The file does not exist.");
    }
    // Check if file already exists
    if (file_exists($target_file)) {
      $error = "Sorry, file already exists.";
      $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 10000000) {
      $error = "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    // Allow certain file formats
    if( $imageFileType != "gif" ) {
      //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $error = 'Sorry, GIF files are allowed.';
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo '<script>alert("Product not uploaded!")</script>'; 
      //echo "Sorry, your file was not uploaded.";
       //$error = 'Sorry, your file was not uploaded.';
    // if everything is ok, try to upload file
    } else {
      $image = $pid . "." . $imageFileType;
      $filepath = $target_dir .  $image;
      if(file_exists($filepath)){
        unlink($filepath);
      }
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath)) {
        //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
         $stmt->execute();
         echo '<script>alert("Products successfully uploaded!")</script>'; 
      } else {
       $error = "Sorry, there was an error uploading your file.";
        //die("Error: The file does not exist.");
      }
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
 
      $stmt = $conn->prepare("UPDATE tbl_products_a175432_final SET FLD_PRODUCT_ID = :pid,
        FLD_PRODUCT_NAME = :name, FLD_PRICE = :price, FLD_BRAND = :brand,
        FLD_TYPE = :type, FLD_QUANTITY = :quantity, FLD_DESCRIPTION = :description,
        FLD_IMAGE = :image
        WHERE FLD_PRODUCT_ID = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_STR);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
      $stmt->bindParam(':image', $image, PDO::PARAM_STR);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    //$image = $_POST['image'];
    $oldpid = $_POST['oldpid'];

    //image uploading
    $target_dir = "products/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      //echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
     // echo "<label id='error' for='quantity' class='col-sm-3 control-label'></label>";
      $error = 'File is not an image';
      $uploadOk = 0;
      //die("Error: The file does not exist.");
    }
    // Check if file already exists
    if (file_exists($target_file)) {
      $error = "Sorry, file already exists.";
      $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 10000000) {
      $error = "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "gif" ) {
      //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $error = 'Sorry, GIF files are allowed.';
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo '<script>alert("Image not uploaded!")</script>'; 
      //echo "Sorry, your file was not uploaded.";
       //$error = 'Sorry, your file was not uploaded.';
    // if everything is ok, try to upload file
    } else {
      $image = $pid . "." . $imageFileType;
      $filepath = $target_dir .  $image;
      if(file_exists($filepath)){
        unlink($filepath);
      }
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath)) {
        echo '<script>alert("Product successfully updated")</script>'; 
        //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        // $stmt->execute();
         //echo '<script>alert("Products successfully !")</script>'; 
      } else {
       $error = "Sorry, there was an error uploading your file.";
        //die("Error: The file does not exist.");
      }
    }
     
    $stmt->execute();
 
    //header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a175432_final WHERE FLD_PRODUCT_ID = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a175432_final WHERE FLD_PRODUCT_ID = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

//search products
if(isset($_POST['search'])) {
  
  try{
    $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;

    $stmt = $conn->prepare("SELECT * FROM tbl_products_a175432_final 
                            WHERE FLD_PRODUCT_NAME LIKE :name1 OR 
                            FLD_PRODUCT_NAME LIKE :name2 OR 
                            FLD_PRODUCT_NAME LIKE :name3 AND
                            FLD_BRAND = :brand AND
                            FLD_TYPE = :type
                            LIMIT $start_from, $per_page"  );
    $stmt->bindParam(':name1', $name1, PDO::PARAM_STR); 
    $stmt->bindParam(':name2', $name2, PDO::PARAM_STR);
    $stmt->bindParam(':name3', $name3, PDO::PARAM_STR);
    $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);

    $searchArr = explode(" ", $_POST['searchProd']);
    $count = count($searchArr);

    $name1 = $searchArr[0].'%';
    $name2 = '%'.$searchArr[0].'%';
    $name3 = '%'.$searchArr[0];
    //echo $count;

    if($count > 1 && $count < 3){
      $brand = $searchArr[1];
      $type = '';
    }elseif ($count > 1 && $count <=3) {
      $brand = $searchArr[1];
      $type = $searchArr[2];
    }
    

    $stmt->execute();
    $searchResult = $stmt->fetchAll();
  }
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
?>