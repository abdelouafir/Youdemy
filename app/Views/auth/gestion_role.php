<?php 
session_start();
$data = $_SESSION['user'] ;
var_dump($data['role']);
if($data['role'] == 'Enseignant'){
    header('location: ../dashboard/Enseignant/home.php');
}elseif($data['role'] == 'student'){
    header('location: ../dashboard/etudiant/student.php');
}elseif($data['role'] == 'admin'){
    header('location: ../dashboard/admin/admin.php');
}

?>