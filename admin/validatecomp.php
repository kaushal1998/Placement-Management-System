<?php
    include '../connection.php';
    global $connect;
    $isvalidate = $_POST['isvalidate'];
    $id = $_POST['id'];
    $query = "UPDATE company SET isverified = '$isvalidate' WHERE id = '$id';";
    if($connect->query($query)){
        echo 'Success';
    }else{
        echo 'fail';
    }
?>