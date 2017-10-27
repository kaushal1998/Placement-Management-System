<?php
    include '../connection.php';
    global $connect;
    $isvalidate = $_POST['isvalidate'];
    $id = $_POST['id'];
    $sid = $_POST['sid'];
    $query = "UPDATE student_details SET isverified = '$isvalidate' WHERE id = '$id';";
    if($connect->query($query)){
        $query2 = "SELECT * FROM student_details WHERE studentId = '$sid' and isverified = '1';";
        $res2 = $connect->query($query2);
        if($res2->num_rows == 6){
            $sum = 0;
            $kts = 0;
            while($row = $res2->fetch_array()){
                $sum += $row['cgpa'];
                $kts += $row['kts'];
            }
            $avg = $sum/6;
            $query3 = "UPDATE student SET avgcgpa = '$avg', totalkts = '$kts' where id = '$sid';";
            $connect->query($query3);
        }
        echo 'Success';
    }else{
        echo 'fail';
    }
?>