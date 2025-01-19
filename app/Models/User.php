<?php 
namespace app\Models;
use PDO;

class User {
    protected $user_name;
    protected $email;
    protected $password;
    protected $role;



    public function register($pdo,$password,$user_name,$email) {
        $passwordHash = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) 
                VALUES (:username, :email, :password_hash)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $user_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $passwordHash);
    
        if ($stmt->execute()) {
            echo 'Utilisateur ajouté avec succès.';
        } else {
            echo 'Échec de l ajout de lutilisateur.';
        }
    }

    public function Enrollment($pdo, $id_cours, $id_etudent) {
        $sql = "INSERT INTO enrollment (student_id, course_id) VALUES (:id_etudent, :id_cours)";
        $stmt = $pdo->prepare($sql);
    
        $stmt->bindParam(':id_etudent', $id_etudent);
        $stmt->bindParam(':id_cours', $id_cours);
        $stmt->execute();
    }

    public function get_mes_cours($pdo,$id){
        $sql = "SELECT 
            courses.id,
            courses.title,
            courses.content,
            courses.description,
            courses.photo,
            courses.prix,
            courses.status,
            courses.video_link,
            users.username,
            users.email,
            categories.name AS category_name
        FROM courses
        JOIN users ON users.id = courses.teacher_id
        JOIN Enrollment ON Enrollment.course_id = courses.id
        JOIN categories ON categories.id = courses.category_id
        WHERE Enrollment.student_id  = $id;
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    
}
?>
