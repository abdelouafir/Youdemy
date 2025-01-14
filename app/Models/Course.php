<?php 
namespace app\Models;
use pdo;
class Course {
    private $Enseignant;
    private $student;
    private $title;
    private $descreption;
    private $content;

    public function get_all__courses($pdo) {
        $sql = "SELECT 
           courses.id,
           courses.title,
           courses.content,
           courses.description,
           users.username,
           categories.name AS category_name
        FROM courses
        JOIN users ON users.id = courses.teacher_id
        JOIN categories ON categories.id = courses.category_id;
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    
}
?>
