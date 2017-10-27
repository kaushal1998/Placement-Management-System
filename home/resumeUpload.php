<?php
include '../connection.php';
global $connect;
$response = array();
$email = $_POST['userid'];
$id = $_POST['id'];
if($_FILES['file']['name'] != ''){
    $extension = pathinfo($_FILES["file"]["name"])['extension'];
    $allowed_type = array("pdf", "PDF");
    if (in_array($extension, $allowed_type)) {
        $new_name = 'Resume.'.$extension;
        $path = getcwd().'\\..\\resumes\\'.$email.'\\'.$new_name;
        $path = mysqli_real_escape_string($connect,$path);
        $dbpath = mysqli_real_escape_string($connect,'resumes/'.$email.'/'.$new_name);
        move_uploaded_file($_FILES['file']['tmp_name'], $path);
        $query = "UPDATE student SET resume = '$dbpath' where id='$id';";
        if($connect->query($query)){
            array_push($response,array('status'=>'Success', 'path'=>$dbpath));
        }else{
            array_push($response,array('status'=>'Failed', 'path'=>''));
        }
    }else{
        array_push($response,array('status'=>'file extension', 'path'=>''));
    }
    echo json_encode(array('response'=>$response));
}
?>