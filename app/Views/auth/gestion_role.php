<?php 
session_start();
$data = $_SESSION['user'] ;

// virfer status de user 


if($data['role'] == 'Enseignant'){
    if($data['status'] == 'block'){
        header('location: ./logout.php');
    }
    elseif($data['status'] == 'attente'){
        header('location: ./message-attente.php');
    }else{
        header('location: ../dashboard/Enseignant/home.php');
    }
   
}elseif($data['role'] == 'student'){
    if($data['status'] == 'block'){
        header('location: ./logout.php');
        
    }elseif($data['status'] == 'attente'){
                header('locatiob: ./message-attente.php');
    }else{
        header('location: ../dashboard/etudiant/student.php');
    }
}elseif($data['role'] == 'admin'){
    if($data['status'] == 'block'){
       header('location: ./logout.php');
    }elseif($data['status'] == 'attente'){
        header('locatiob: ./message-attente.php');
    }
    else{
        header('location: ../dashboard/admin/admin.php');
    }
}


?>