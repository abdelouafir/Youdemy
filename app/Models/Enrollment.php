<?php 
namespace app\Models;
require_once dirname(__FILE__, 3) . '/vendor/autoload.php';
use app\Models\user;
use PDO;
use app\Config\Database;

$conn = new Database();
$conction = $conn->getConnection();

class Enrollment extends user {
    
    public function get_all_courses($pdo) {
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
        JOIN categories ON categories.id = courses.category_id;
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    public function get_cours($pdo, $id) {
        $sql = "SELECT 
            courses.id,
            courses.title,
            courses.content,
            courses.description,
            courses.photo,
            courses.prix,
            courses.status,
            courses.video_link,
            courses.Niveau,
            courses.type,
            users.username,
            users.email,
            categories.name AS category_name
        FROM courses
        JOIN users ON users.id = courses.teacher_id
        JOIN categories ON categories.id = courses.category_id
        WHERE courses.id = :id"; 
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    public function get_all_mycours($pdo,$id) {
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
        JOIN categories ON categories.id = courses.category_id
        WHERE courses.teacher_id = :id";
         $stmt = $pdo->prepare($sql);
         $stmt->bindParam(':id', $id);
         $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }


    public function get_all_courses_activer($pdo) {
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
        JOIN categories ON categories.id = courses.category_id
        WHERE courses.status = 'active';
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    public function delete_cours($connection, $id) {
        $sql = "DELETE FROM courses WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function update_status($pdo, $id) {
        $status = 'active';
        $sql = "UPDATE courses 
                SET status = :status
                WHERE id = :id";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $valur = $stmt->execute(); 
        print_r($valur);
        return $valur;
    }
    public function update_status_ban($pdo, $id) {
        $status = 'attente';
        $sql = "UPDATE courses 
                SET status = :status
                WHERE id = :id";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $valur = $stmt->execute(); 
        print_r($valur);
        return $valur;
    }
    public function search_courses($connection, $searchTerm)
{
    $query = "SELECT * FROM courses 
    WHERE (title LIKE :search OR description LIKE :search) AND courses.status = 'active';";
    $stmt = $connection->prepare($query);
    $searchTerm = '%' . $searchTerm . '%';
    $stmt->bindParam(':search', $searchTerm);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}

?>