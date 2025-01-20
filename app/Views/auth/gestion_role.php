<?php 
session_start();
$data = $_SESSION['user'] ;
var_dump($data['status']);
// virfer status de user 


if($data['role'] == 'Enseignant'){
    if($data['status'] == 'block'){
        header('location: ./logout.php');
    }else{
        header('location: ../dashboard/Enseignant/home.php');
    }
   
}elseif($data['role'] == 'student'){
    if($data['status'] == 'block'){
        header('location: ./logout.php');
        echo "hello ahmed";
    }else{
        header('location: ../dashboard/etudiant/student.php');
    }
}elseif($data['role'] == 'admin'){if($data['status'] == 'block'){
    header('location: ./logout.php');
    echo "hello ahmed";
}else{
    header('location: ../dashboard/admin/admin.php');
}
}

?>