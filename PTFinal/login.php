<?php 

include_once 'database.php';
$error = '';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    try {
        $stmt = $conn->prepare("SELECT FLD_STAFF_ID, FLD_STAFF_NAME, FLD_STAFF_EMAIL, FLD_STAFF_TYPE, FLD_STAFF_PASSWORD FROM tbl_staffs_a175432_final where FLD_STAFF_EMAIL = :email");

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
       // $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $email =  $_POST['email'];
        $password =  $_POST['password'];

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //echo $result['FLD_STAFF_PASSWORD'];
        
        if($result){
            $checkEmail = $result['FLD_STAFF_EMAIL'];
            $checkPass = $result['FLD_STAFF_PASSWORD'];
            if(password_verify($password, $checkPass)){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['name'] = $result['FLD_STAFF_NAME'];
                $_SESSION['type'] = $result['FLD_STAFF_TYPE'];

                header("location: index.php");
            }else{
                $error = 'invalid password';
            }
        }else{
            //echo $result;
            $error = 'invalid email';
        }
    }
    catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Best Bird Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
    background: #5DDBEB;
}
.login-form {
    width: 340px;
    margin: 50px auto;
    margin-top: 10px;
    font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #EB6D5D;
    box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
    color: black;
    background: #5DDBEB;
}
</style>
</head>
<body>
<div class="text-center">
    <img src="logo.png" class="img-responsive">
</div>
<div class="login-form">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2 class="text-center">Best Bird Login</h2>       
        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
           <p style="color: red;"><?php echo $error ?> </p>
        </div>        
    </form>
    <p class="text-center"> 
        Note to lecturer:<br>
        For admin: admin@gmail.com, a1234<br>
        For normal staff: nordin@gmail.com, 12345
    </p>

</div>
</body>
</html>