<?php
session_start();
$_SESSION['loggedinComp'] = false;
$_SESSION['email'] = '';
session_unset();
session_write_close();
header('Location: ../login/');
?>