<?php

include '../connection.php';
global $connect;

$companyId = $_POST['cid'];
$studentId = $_POST['id'];

$query = "SELECT * FROM placement WHERE studentId = '$studentId' and companyId = '$companyId' and isPlaced = 1;";
$query3 = "SELECT * FROM placement WHERE studentId = '$studentId' and companyId = '$companyId' and isPlaced = 0;";
$res = $connect->query($query);
$res3 = $connect->query($query3);
if($res->num_rows != 0){
    echo 'already placed';
}else if($res3->num_rows != 0){
    echo 'already added';
}else{
    $query2 = "INSERT INTO placement(studentId, companyId) VALUES ('$studentId', '$companyId');";
    if($connect->query($query2)){
        echo 'added';
    }else{
        echo 'failed';
    }
}
?>