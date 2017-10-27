<!DOCTYPE html>

<?php
session_start();
$errors = array();
if(isset($_POST['logadmin'])){
    $no = $_POST['adminno'];
    $pass = $_POST['password'];
    if($no == '123' && $pass == '123'){
        $_SESSION['admin'] = true;
        header('Location: index.php');
    }else{
        array_push($errors, "Username or password is not correct");
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="adlogin.css?<?php echo time();?>">
    <title>Admin Login</title>
</head>
<body>
    <div class="admin">
         <div class="form2" id="logAdmin">
                <form name = "Login_Form1" action = "admin-login.php" method = "post">
                    <div>
                        <label for="adminno">Enter Admin No:</label>
                        <input type = "text" name = "adminno" id = "adminno"/>
                    </div>
                    <div>
                        <label for="password">Enter Password:</label>
                        <input type = "password" name = "password" id = "password"/>
                    </div></br>
                    <?php if(sizeof($errors) > 0){?><div class="errors">Invalid username or password!</div><?php }?>
                    <div><input type = "submit" value = "Login" class = "logadmin" name="logadmin"/></div>
                </form>
            </div>
    </div>
</body>
</html>