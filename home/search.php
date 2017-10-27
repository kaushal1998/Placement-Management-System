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
$query2 = "SELECT * FROM student_details WHERE studentId = '$id';";
$res2 = $connect->query($query2);
$query3 = "SELECT * FROM company WHERE limitcgpa <= '$avgcgpa' and isverified = '1';";
$res3 = $connect->query($query3);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="search.css?<?php echo time();?>">
    <title>Search</title>
</head>
<body>
    <header>
        <h1 id="vpms">VESIT Placement Management System</h1>
        <a href="logout.php"><div id="logout">Logout</div></a>
    </header>
    <div class="content">
        <?php while($row3 = $res3->fetch_array()){?>
            <div class="onebox">
                <div id="name"><?php echo $row3['name']?></div>
                <div id="regno">Registration no: <?php echo $row3['registrationId'];?></div>
                <div id="vacancy">Vacancy: <?php echo $row3['vacancy']?></div>
                <?php
                $cid = $row3['id']; 
                $resm = mysqli_query($connect, "SELECT * FROM placement WHERE companyId = '$cid' and studentId = '$id';");
                if($resm->num_rows == 0){
                ?>
                <button class="applynow <?php echo $row3['id'];?>" <?php if($avgcgpa == 0){echo 'disabled="disabled";';} ?> onclick="applynow(<?php echo $row3['id'];?>, <?php echo $id;?>)">Apply Now</button>
                <?php }else{?>
                <button class="applynow">Applied</button>  
                <?php }?>
            </div>
        <?php }?>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="search.js"></script>
</body>
</html>