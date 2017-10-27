<?php
include '../connection.php';
global $connect;
$id = $_POST['id'];
$query3 = "SELECT * from placement WHERE id='$id';";
$res3 = $connect->query($query3);
$row3 = $res3->fetch_array();
$query = "UPDATE placement SET isPlaced = '2' WHERE id = '$id';";
$cid = $row3['companyId'];
$sid = $row3['studentId'];
$query2 = "UPDATE student SET placedat = '$cid' WHERE id = '$sid';";
if($connect->query($query) && $connect->query($query2)){
    echo 'Success';
}else{
    echo 'Failed';
}
?>