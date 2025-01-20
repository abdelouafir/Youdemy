<?php
session_start();
$data = $_SESSION['user'] ;
session_unset();
session_destroy();

if($data['status'] == 'block'){
    header("Location: ./404.php");
}else{
    header("Location: ./login.php");
}

exit();

?>