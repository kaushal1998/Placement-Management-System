<!DOCTYPE html>
<?php
    session_start();
    if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
        header('Location: ../');
    }
    include '../connection.php';
    global $connect;
    $query = "SELECT student.id as sid, student.name, student.user_id, student.branch, student.class, student.roll_no, student_details.id as id, student_details.studentId, student_details.semno, student_details.cgpa, student_details.kts FROM `student_details` LEFT JOIN student ON student.id = student_details.studentId WHERE student_details.isverified = 0;";
    $res = $connect->query($query);
    $query2 = "SELECT * FROM company WHERE isverified='0';";
    $res2 = $connect->query($query2);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index.css?<?php echo time();?>">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <title>Admin</title>
</head>
<body>
    <header>
        <h1 id="vpms">VESIT Placement Management System</h1>
        <a href="logout.php"><div id="logout">Logout</div></a>
    </header>
    <div class="admin_info">
        <div id="name">Admin Account</div>
    </div>
    <div class="student_verification">
        <?php if($res->num_rows != 0){ 
            while($row = $res->fetch_array()){
                $sid=$row['id']; ?>
                <div class="onebox <?php echo $row['id']?>">
                    <div id="student_name"><?php echo $row['name']?></div>
                    <div id="class"><?php echo $row['class']?></div>
                    <div id="rollno"><?php echo $row['roll_no']?></div>
                    <div id="semno">Sem No: <strong><?php echo $row['semno']?></strong> | CGPA: <?php echo $row['cgpa']?></div>
                    <div id="kts">KTs: <?php echo $row['kts']?></div>
                    <button class="validate <?php echo $row['id']?>" onclick="validate(1, <?php echo $row['id']?>, <?php echo $row['sid']?>)">Validate</button>
                    <button class="invalidate <?php echo $row['id']?>" onclick="validate(-1, <?php echo $row['id']?>, <?php echo $row['sid']?>)">Invalidate, Send Back</button>
                </div>
                <?php }
        }?>
    </div>
    <div class="company_verification">
        <?php if($res2->num_rows != 0){ 
                while($row2 = $res2->fetch_array()){
                    $cid=$row2['id']; ?>
            <div class="box <?php echo $cid;?>">
                <div id="company_name">Name: <?php echo $row2['name'];?></div>
                <div id="regno">Reg. No: <?php echo $row2['registrationId'];?></div>
                <div id="email">Email: <?php echo $row2['email'];?></div>
                <button class="validateComp" onclick="validateComp(1, <?php echo $row2['id']?>)">Validate</button>
                <button class="invalidateComp" onclick="validateComp(-1, <?php echo $row2['id']?>)">Invalidate</button>
            </div>
            <?php }
        }?>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="admin.js"></script>
</body>
</html>