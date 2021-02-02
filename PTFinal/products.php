<?php
  $searchResult = '';
  include_once 'products_crud.php';
 // $error = '';

  session_start();
  if($_SESSION['loggedin'] == false){
    header("Location: index.php");
  }
  if($_SESSION['type'] == 'normal'){
    $hide = 'display:none;';
  }else{
    $hide = '';
  }
  
?>

<!DOCTYPE html>
<html>
<head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>My Bird Shop : Products</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet"> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript">
     $(document).ready(function() {
      $("body,html").animate(
      {
        scrollTop: $("#newRow").offset().top
      },
      1000 //speed
      );
     });
    </script>
    <script src="js/bootstrap.min.js"></script>
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

  <?php include_once 'nav_bar.php'; ?>

  <div  class="container-fluid">
    <div style="<?php echo $hide ?>" class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Product</h2>
      </div>
 
    <form action="products.php" method="post" class="form-horizontal" enctype="multipart/form-data">

       <div class="form-group">
      <label for="pid" class="col-sm-3 control-label">Product ID</label>
      <div class="col-sm-9">
      <input name="pid" type="text" class="form-control" id="pid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_ID']; ?>" required>
      </div>
      </div>

      <div class="form-group">
      <label for="name" class="col-sm-3 control-label">Product Name</label>
      <div class="col-sm-9">
      <input name="name" type="text" class="form-control" id="name" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_NAME']; ?>" required>
      </div>
      </div>

      <div class="form-group">
      <label for="price" class="col-sm-3 control-label">Price</label>
      <div class="col-sm-9">
       <input name="price" type="number" class="form-control" id="price" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRICE']; ?>" min="0.0" step="0.01" required>
      </div>
      </div>

      <div class="form-group">
      <label for="brand" class="col-sm-3 control-label">Brand</label>
      <div class="col-sm-9">
      <select name="brand" class="form-control" id="brand" required>
            <option value="">Please select</option>
            <option value="Petco" <?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Petco") echo "selected"; ?>>Petco</option>
            <option value="Brenda's Birds" <?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Brenda's Birds") echo "selected"; ?>>Brenda's Birds</option>
            <option value="World Of Birds" <?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="World Of Birds") echo "selected"; ?>>World Of Birds</option>
            <option value="World Of Pets" <?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="World Of Pets") echo "selected"; ?>>World Of Pets</option>
            <option value="Pet Smart" <?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Pet Smart") echo "selected"; ?>>Pet Smart</option>
            <option value="Bird World" <?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Bird World") echo "selected"; ?>>Bird World</option>
            <option value="ZuPreem" <?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="ZuPreem") echo "selected"; ?>>ZuPreem</option>
            <option value="Lafeber's" <?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="Lafeber's") echo "selected"; ?>>Lafeber's</option>
            <option value="All Living Things" <?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="All Living Things") echo "selected"; ?>>All Living Things</option>
            <option value="A&E" <?php if(isset($_GET['edit'])) if($editrow['FLD_BRAND']=="A&E") echo "selected"; ?>>A&E</option>
     </select>
      </div>
      </div>   

      <div class="form-group">
      <label for="type" class="col-sm-3 control-label">Product Type</label>
      <div class="col-sm-9">
      <select name="type" class="form-control" id="type" required>
            <option value="">Please select</option>
            <option value="Bird" <?php if(isset($_GET['edit'])) if($editrow['FLD_TYPE']=="Bird") echo "selected"; ?>>Bird</option>
            <option value="Food" <?php if(isset($_GET['edit'])) if($editrow['FLD_TYPE']=="Food") echo "selected"; ?>>Food</option>
            <option value="Supplies" <?php if(isset($_GET['edit'])) if($editrow['FLD_TYPE']=="Supplies") echo "selected"; ?>>Supplies</option>
     </select>
      </div>
      </div> 

      <div class="form-group">
        <label for="quantity" class="col-sm-3 control-label">Quantity</label>
        <div class="col-sm-9">
      <input name="quantity" type="number" class="form-control" id="quantity" placeholder="Product Quantity" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_QUANTITY']; ?>"  min="0" required>
      </div>
      </div>

      <div class="form-group">
      <label for="description" class="col-sm-3 control-label">Description</label>
      <div class="col-sm-9">
      <textarea name="description" class="form-control" id="description" rows="4" cols="50" placeholder="Enter product description"><?php if(isset($_GET['edit'])) echo $editrow['FLD_DESCRIPTION']; ?></textarea>
      </div>
      </div>
      <!--Image Upload -->
      <div class="form-group">
        <label for="quantity" class="col-sm-3 control-label">Upload Image</label>
        <div class="col-sm-9">
        <input name="fileToUpload" type="file" class="" id="fileToUpload" required>
        </div>
        
        <label style="color: red;" id="error" for="quantity" class="col-sm-3 control-label">
          <?php 
          if($error != null){
            echo $error;
          }
           
          ?>  
        </label>
      </div>

      <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['FLD_PRODUCT_ID']; ?>">
       <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
      <?php } else { ?>
      <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
       <?php } ?>
       <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
      </div>
      </div>
    </form>
  </div>
</div>

<div id="productsList" class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Products List</h2>
      </div>

      <form action="products.php" method="post" class="form-horizontal"> 
      <div class="row form-group">
        <label for="searchProd" class="col-sm-2 control-label">Search Products :</label>
        <div class="col-sm-5">
         <input id="inputSearch" name="searchProd" type="text" class="form-control" id="pid" placeholder="Enter keywords" value="" required>
        </div>
        <button id="btnSearch" class="btn btn-default" type="submit" name="search" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</button>
      </div>
      </form>
      
      <div>
      <table class="table table-striped table-bordered">
      <tr>
        <th>Product ID</th>
          <th>Name</th>
          <th>Price (RM)</th>
          <th>Brand</th>
          <th>Type</th>
          <th>Description</th>
          <th></th>
      </tr>

      <?php
      if($searchResult != null){
        foreach ($searchResult as $readrow) {
        ?>
        <tr id="newRow">
          <td><?php echo $readrow['FLD_PRODUCT_ID']; ?></td>
          <td><?php echo $readrow['FLD_PRODUCT_NAME']; ?></td>
          <td><?php echo $readrow['FLD_PRICE']; ?></td>
          <td><?php echo $readrow['FLD_BRAND']; ?></td>
          <td><?php echo $readrow['FLD_TYPE']; ?></td>
          <td><?php echo $readrow['FLD_DESCRIPTION']; ?></td>
          <td>
            <a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
            <a style="<?php echo $hide ?>" href="products.php?edit=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
            <a style="<?php echo $hide ?>" href="products.php?delete=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
          </td>
        </tr> 
        <?php  
        }
      }else{
      // Read
      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;

      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select * from tbl_products_a175432_final LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>   
      <tr>
        <td><?php echo $readrow['FLD_PRODUCT_ID']; ?></td>
        <td><?php echo $readrow['FLD_PRODUCT_NAME']; ?></td>
        <td><?php echo $readrow['FLD_PRICE']; ?></td>
        <td><?php echo $readrow['FLD_BRAND']; ?></td>
        <td><?php echo $readrow['FLD_TYPE']; ?></td>
        <td><?php echo $readrow['FLD_DESCRIPTION']; ?></td>
        <td>
          <a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
          <a style="<?php echo $hide ?>" href="products.php?edit=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
          <a style="<?php echo $hide ?>" href="products.php?delete=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
        </td>
      </tr>
      <?php
      }
     }
      $conn = null;
      ?>
    </table>
    </div>
   </div>
  </div>

    <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a175432_final");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
    </div>
</div>

   
</body>
</html>