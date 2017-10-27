<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['loggedinComp']) || !$_SESSION['loggedinComp']) {
    header('Location: ../');
}
$regno = $_SESSION['regno'];
include '../connection.php';
global $connect;
$query = "SELECT * FROM company where registrationId='$regno';";
$res = $connect->query($query);
$row = $res->fetch_array();
$limit = $row['limitcgpa'];
$cid = $row['id'];
if(isset($_POST['submitLimit'])){
    $limit = mysqli_real_escape_string($connect, $_POST['limit']);
    $query2 = "UPDATE company SET limitcgpa = '$limit' WHERE registrationId='$regno';";
    if($connect->query($query2)){
        
    }
}
$query2 = "SELECT placement.id, student.id as sid, student.name,student.user_id, student.branch, student.class, student.roll_no, student.avgcgpa, student.totalkts, student.resume, placement.isPlaced FROM placement LEFT JOIN student ON placement.studentId = student.id WHERE placement.companyId = '$cid'";
$res2 = $connect->query($query2);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="index.css?<?php echo time();?>">
    <title>Company</title>
</head>
<body>
    <header>
        <h1 id="vpms">VESIT Placement Management System</h1>
        <a href="logout.php"><div id="logout">Logout</div></a>
    </header>
    <div class="company_info">
        <div id="name">Name: <?php echo $row['name'];?></div>
        <div id="regno">Reg No.: <?php echo $row['registrationId'];?></div>
    </div>
    <div class="setLimit">
        <div id="current_limit">Your Current Limit: <?php echo $limit;?> CGPA</div>
        <div id="title">Set New Limit:</div>
        <form action="index.php" method="POST" onsubmit="return validate()">
            <div class="form-control">
                <input type="number" name="limit" id="limit" placeholder="Enter new CGPA">
                <input type="submit" name="submitLimit" id="submitLimit" value="Update Limit">
            </div>
        </form>
    </div>
    <div class="studentList">
        <?php if($res2->num_rows != 0){
            while($row2 = $res2->fetch_array()){?>
            <div class="onebox">
                <div id="sname">Name: <?php echo $row2['name'];?></div>
                <div id="branch">Branch: <?php echo $row2['branch'];?></div>
                <div id="class">Class: <?php echo $row2['class'];?></div>
                <div id="rollno">Roll No: <?php echo $row2['roll_no'];?></div>
                <div id="avgcgpa">Avg. CGPA: <?php echo $row2['avgcgpa'];?></div>
                <div id="avgcgpa">Total KTs: <?php echo $row2['totalkts'];?></div>
                <div class="view <?php echo $row2['id'];?>" onclick="showdetails(<?php echo $row2['id'];?>)">view details</div>
                <div class="details <?php echo $row2['id'];?>">
                    <?php $sid = $row2['sid'];
                    $res3 = mysqli_query($connect, "SELECT * FROM student_details WHERE studentId='$sid' order by semno;");
                    while($row3 = $res3->fetch_array()){
                        ?>
                            <div class="box">
                                <div id="semno">Sem No: <?php echo $row3['semno'];?> | CGPA: <?php echo $row3['cgpa'];?></div>
                            </div>
                        <?php
                    }?>
                    <a href="../<?php echo $row2['resume'];?>" target="_blank"><div id="resume">See Resume</div></a>
                </div>
                <?php if($row2['isPlaced'] == 0){?>
                    <button class="call <?php echo $row2['id'];?>" onclick="call(<?php echo $row2['id'];?>,1)">Call for JOB</button>
                <?php }else{?>
                    <button class="call <?php echo $row2['id'];?>" onclick="call(<?php echo $row2['id'];?>,0)">Called, Cancel Job Request</button>
                    <?php }?>
            </div>
            <?php }
        }?>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="company.js"></script>
    <input type="hidden" name="login_id" id="login_id" value="<?php echo $_SESSION['login_id'];?>">
</body>
</html>