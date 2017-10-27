<?php
include '../connection.php';
global $connect;
$id = $_POST['id'];
$value = $_POST['value'];
$query = "UPDATE placement SET isPlaced = '$value' WHERE id = '$id' ;";
if($connect->query($query) && $value == 1){
    echo 'Success';
}else if($connect->query($query) && $value == 0){
    echo 'SuccessO';
}else{
    echo 'Failed';
}
?>