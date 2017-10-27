<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    header('Location: ../home/');
}else if(isset($_SESSION['loggedinComp']) && $_SESSION['loggedinComp']){
    header('Location: ../company/');
}
include '../connection.php';
global $connect;
$errors = array();
$flag = false;
$compflag = false;
if(isset($_POST['regComp'])){
    $name = mysqli_real_escape_string($connect, $_POST['cname']) ;
    $regno = mysqli_real_escape_string($connect, $_POST['regno']);
    $email = mysqli_real_escape_string($connect, $_POST['cemail']);
    $password = mysqli_real_escape_string($connect, $_POST['cpassword']);
    $vacancy = mysqli_real_escape_string($connect, $_POST['vacancy']);
    $regCompQuery = "SELECT * FROM company where registrationId = '$regno';";
    $regCompRes = $connect->query($regCompQuery);
    if($regCompRes->num_rows != 0){
        $compflag = true;
    }else{
        $insCompQuery = "INSERT INTO company(name, registrationId, password, email, vacancy) VALUES('$name', '$regno', '$password', '$email', '$vacancy');";
        $resinsQuery = $connect->query($insCompQuery);
        if($resinsQuery){
            $_SESSION['loggedinComp'] = true;
            $_SESSION['regno'] = $regno; 
            header('Location: ../company/');
        }
    }
}
if(isset($_POST['logComp'])){
    $cid = mysqli_real_escape_string($connect, $_POST['cid']);
    $password = mysqli_real_escape_string($connect, $_POST['cpass']);
    $query = "SELECT * from company where registrationId = '$cid' and password='$password';";
    $res = $connect->query($query);
    if($res->num_rows != 0){
        $_SESSION['loggedinComp'] = true;
        $_SESSION['regno'] = $cid; 
        header('Location: ../company/');
    }else{
        array_push($errors, "Invalid username or password!");
    }
}
if(isset($_POST['regstu'])){
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $class = mysqli_real_escape_string($connect, $_POST['class']);
    $branch = mysqli_real_escape_string($connect, $_POST['branch']);
    $rollno = mysqli_real_escape_string($connect, $_POST['rollno']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $query = "SELECT * from student where user_id = '$email';";
    $res = $connect->query($query);
    if($res->num_rows != 0){
        $flag = true;
    }else{
        $insquery = "INSERT INTO student(name, user_id, password, branch, class, roll_no) VALUES('$name', '$email', '$password', '$branch', '$class', '$rollno');";
        $res = $connect->query($insquery);
        if($res){
            mkdir(getcwd().'\\..\\resumes\\'.$email);
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email; 
            header('Location: ../home/');
        }
    }
}
if(isset($_POST['logstu'])){
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $query = "SELECT * from student where user_id = '$email' and password='$password';";
    $res = $connect->query($query);
    if($res->num_rows != 0){
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email; 
        header('Location: ../home/');
    }else{
        array_push($errors, "Invalid username or password!");
    }
}
?>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Noto+Serif" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
        <link rel = "stylesheet" type = "text/css" href = "login.css?<?php echo time();?>">
        <title>
            Placement Management System
        </title>
    </head>
    <body>
        <a href="../admin/admin-login.php"><div class="admin">Admin</div></a>
        <h1 align = "center">VESIT Placement Management System</h1>
        <div class="student">
            <div class="alreadyAcc" id="alreadyAcc" style="display: none">
                Seems Like given email-id is already registered with us!</br>
                <button id="allogin" onclick="alloginPress()">Login with that email-id</button>
                <button id="alreg" onclick="alregPress()">Try different email-id</button>
            </div>
            <div class="regStudent" id="regStudent" style="display: none;">
                <form name = "register_form" action = "index.php" onsubmit = "return validationRegStu()" method = "post">
                    <div>
                        <label for="name">Enter Name:</label></br>
                        <input type = "text" name = "name" id = "name"/>
                    </div>
                    <div class="rgbr">
                        <label for="branch">Enter Branch:</label></br>
                        <input type = "text" name = "branch" id = "branch"/>
                    </div>
                    <div class="rgcl">
                        <label for="class">Enter Class:</label></br>
                        <input type = "text" name = "class" id = "class"/>
                    </div>
                    <div class="rgrl">
                        <label for="rollno">Enter Roll No:</label></br>
                        <input type = "number" name = "rollno" id = "rollno"/>
                    </div>
                    <div>
                        <label for="email">Enter E-mail:</label></br>
                        <input type = "text" name = "email" id = "email"/>
                    </div>
                    <div>
                        <label for="password">Enter Password:</label></br>
                        <input type = "password" name = "password" id = "password"/>
                    </div>
                    <div>
                        <label for="repassword">Re-Enter Password:</label></br>
                        <input type = "password" name = "repassword" id = "repassword"/>
                    </div>
                    <div><input type = "submit" value = "Register" class = "submit" name="regstu"/></br></div>
                    <div class="regpage" onclick="showLogin()">or sing in</div>
                </form>
            </div>
            <div class="form1" id="logStudent">
                <form name = "Login_Form1" action = "index.php" onsubmit = "return validationLogStu()" method = "post">
                    <div>
                        <label for="email">Enter E-mail:</label>
                        <input type = "text" name = "email" id = "logemail"/>
                    </div>
                    <div>
                        <label for="password">Enter Password:</label>
                        <input type = "password" name = "password" id = "logpassword"/>
                    </div></br>
                    <?php if(sizeof($errors) > 0){?><div class="errors">Invalid username or password!</div><?php }?>
                    <div><input type = "submit" value = "Login" class = "logstu" name="logstu"/></div>
                    <div class="regpage" onclick="showRegister()">Not yet registered, click here!</div>
                </form>
            </div>
    	</div>
        <div class="company">
            <div class="alreadyAccCompany" id="alreadyAccCompany" style="display: none">
                Seems Like given email-id is already registered with us!</br>
                <button id="allogin" onclick="alcomploginPress()">Login with that email-id</button>
                <button id="alreg" onclick="alcompregPress()">Try different email-id</button>
            </div>
            <div class="regCompany" id="regCompany" style="display: none;">
                <form name = "register_form" action = "index.php" onsubmit = "return validationRegCom()" method = "post">
                    <div>
                        <label for="name">Enter Comapny Name:</label></br>
                        <input type = "text" name = "cname" id = "cname"/>
                    </div>
                    <div>
                        <label for="regno">Enter Registraion No.:</label></br>
                        <input type = "text" name = "regno" id = "regno"/>
                    </div>
                    <div>
                        <label for="vacancy">Enter Vacancy:</label></br>
                        <input type = "number" name = "vacancy" id = "vacancy"/>
                    </div>
                    <div>
                        <label for="cemail">Enter E-mail:</label></br>
                        <input type = "text" name = "cemail" id = "cemail"/>
                    </div>
                    <div>
                        <label for="cpassword">Enter Password:</label></br>
                        <input type = "password" name = "cpassword" id = "cpassword"/>
                    </div>
                    <div>
                        <label for="crepassword">Re-Enter Password:</label></br>
                        <input type = "password" name = "crepassword" id = "crepassword"/>
                    </div>
                    <div><input type = "submit" value = "Register" class = "submit" name="regComp"/></br></div>
                    <div class="regpage" onclick="showLoginCom()">or sing in</div>
                </form>
            </div>
            <div class="form2" id="logCompany">
                <form name = "Login_Form2" action = "index.php" onsubmit = "return validationLoginCom()" method = "post">
                    <div>
                        <label for="cid">Enter Registation-id:</label>
                        <input type = "text" name = "cid" id = "cid"/>
                    </div>
                    <div>
                        <label for="cpass">Enter Password:</label>
                        <input type = "password" name = "cpass" id = "cpass"/>
                    </div>
                    <div><input type = "submit" value = "Login" class = "submit" name="logComp"/></br></div>
                    <div class="regpagecom" onclick="showRegisterCom()">New Company, Register now!</div>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="login.js"></script>
        <?php
        if($flag){
            ?><script>
                 document.getElementById('regStudent').style.display = 'none';
                 document.getElementById('logStudent').style.display = 'none';
                 document.getElementById('alreadyAcc').style.display = 'block';
                </script><?php
        }
        if($compflag){
            ?><script>
                 document.getElementById('regCompany').style.display = 'none';
                 document.getElementById('logCompany').style.display = 'none';
                 document.getElementById('alreadyAccCompany').style.display = 'block';
                </script><?php
        }
        ?>

    </body>
</html>
