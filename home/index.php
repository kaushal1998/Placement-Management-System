<!DOCTYPE html>
<?php 
session_start();
include '../connection.php';
global $connect;
$flag = false;
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: ../');
}
$email = $_SESSION['email'];
$query = "SELECT * FROM student where user_id = '$email';";
$res = $connect->query($query);
$row = $res->fetch_array();
$id = $row['id'];
$name = $row['name'];
$branch = $row['branch'];
$class = $row['class'];
$roll_no = $row['roll_no'];
$resume = $row['resume'];
$avgcgpa = $row['avgcgpa'];
$totalkts = $row['totalkts'];
$placedat = $row['placedat'];
$query4 = "SELECT * FROM student_details WHERE studentId = '$id';";
$res4 = $connect->query($query4);

$query5 = "SELECT placement.id, company.id AS cid, company.name, company.registrationId, company.email from placement LEFT JOIN company on placement.companyId = company.id WHERE placement.studentId = '$id' AND placement.isPlaced = 1";
$res5 = $connect->query($query5);

if(isset($_POST['submitM'])){
    $semno = mysqli_real_escape_string($connect, $_POST['sem']);
    $cgpa = mysqli_real_escape_string($connect, $_POST['cgpa']);
    if($_POST['kt'])
        $kt = $_POST['kt'];
    else
        $kt = 0;
    $query1 = "SELECT * FROM student_details where studentId = '$id' and semno = '$semno';";
    $res = $connect->query($query1);
    if($res->num_rows != 0){
        $updateQuery = "UPDATE student_details SET cgpa = '$cgpa', kts = '$kt', isverified = '0' WHERE semno = '$semno' and studentId = '$id';";
        if($connect->query($updateQuery)){
            $flag = true;
        }
    }else{
        $query2 = "INSERT INTO student_details(studentId, semno, cgpa, kts) VALUES('$id','$semno','$cgpa','$kt');";
        if($connect->query($query2)){
            $flag = true;
        }
    }
    
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="home.css?<?php echo time();?>">
    <title>Home</title>
</head>
<body>
    <header>
        <h1 id="vpms">VESIT Placement Management System</h1>
        <a href="logout.php"><div id="logout">Logout</div></a>
    </header>
    <div class="student_info">
        <a href="search.php"><div id="searchicon" title="Search job according to your pointer!"></div></a>
        <div id="name">Name: <?php echo $name;?></div>
        <div id="class">Class: <?php echo $class;?></div>
        <div id="rollno">Roll No.: <?php echo $roll_no;?></div>
    </div>
    <?php if($placedat != 0){?>
    <div class="placedat">
        <?php $resmq = mysqli_query($connect, "SELECT * FROM company WHERE id='$placedat';");
        $rowmq = $resmq->fetch_array();?>
        <div id="placetitle">You are placed at <?php echo $rowmq['name'];?></div>
    </div>
    <?php }else{ ?>
    <div class="company_info">
        <?php if($res5->num_rows != 0){
            while($row5 = $res5->fetch_array()){ ?>
            <div class="box">
                <div id="cname">Name: <?php echo $row5['name'];?></div>
                <div id="regid">Registration No.: <?php echo $row5['registrationId'];?></div>
                <button class="join <?php echo $row5['id'];?>" onclick="join(<?php echo $row5['id'];?>)">Join</button>
            </div>
            <?php
            }
        }
    }?>
    </div>
    <div class="uploadmarks">

        <?php
            if($res4->num_rows != 0){
                ?><div class="sem_details"><?php
                while($row2 = $res4->fetch_array()){
                    ?>
                    <div class="onebox">
                        <div id="semno">Sem No: <?php echo $row2['semno'];?> | CGPI: <?php echo $row2['cgpa'];?></div>
                        <div id="status"><?php if($row2['isverified'] == 0){echo 'verification pending';}else if($row2['isverified'] == 1){echo 'Verified';}else{echo 'Not Correct!'; }?></div>
                    </div>
                    <?php
                }?>
                <div class="onebox">
                    <div id="semno">Average CGPA: <?php echo $row['avgcgpa'];?></div>
                </div>
                <div class="onebox">
                    <div id="semno">Total KTs: <?php echo $row['totalkts'];?></div>
                </div>
                </div><?php
            }
        ?>
        <div id="title">Enter Your Marks: </div>
        <form action="index.php" method="POST" onsubmit="return validate()">
            <div class="form-control">
                <select name="sem" id="sem">
                    <option value="0" selected disabled hidden>Choose Semester</option>
                    <option value="1">SEM I</option>
                    <option value="2">SEM II</option>
                    <option value="3">SEM III</option>
                    <option value="4">SEM IV</option>
                    <option value="5">SEM V</option>
                    <option value="6">SEM VI</option>
                </select>
                <input type="number" placeholder="CGPA" name="cgpa" id="cgpa" min="0" step="0.01">
                <input type="number" placeholder="No. of KTS" name="kt" id="kt">
            </div>
            <?php if($flag){?><div>Marks updated!</div><?php }?>
            <input type="submit" id="submitM" value="Update Marks" name="submitM">
        </form>
    </div>
    <div class="uploadskills">
    <?php if($resume && $resume != ''){?>
        <div class="resume_container">
            <div class="resume">
                <object data="../<?php echo $resume;?>" id="my_resume"></object>
                <a href="../<?php echo $resume;?>" target="_blank" title="Open in new tab"><div id="open_in_new"></div></a> 
            </div>
            <div class="reupload">
                <div class="uploadbox">
                    <div class="form-control2">
                        <input type="file" name="resume2" id="resume2">
                    </div>
                </div>
                <button id="reuploadbutton">Re-Upload your Resume</button>
            </div>
        </div>
    <?php }else{?> 
        <div id="title">Upload your Resume: </div>
        <div class="form-control">
            <input type="file" name="resume" id="resume">
            <input type="button" value="Upload Resume" id="resumeUpload">
        </div>
    <?php }?>
    </div>
    <input type="hidden" name="email" id="semail" value="<?php echo $_SESSION['email'];?>">
    <input type="hidden" name="sid" id="sid" value="<?php echo $id;?>">
    <script src="../js/jquery.js"></script>
    <script src="home.js"></script>
</body>
</html>