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
    // public function update_courses($pdo, $id, $title, $description,$content,$category_id,$image_url) {
    //     $sql = "UPDATE courses 
    //             SET title = :title,description = :description, content = :content, category_id = :category_id ,photo = :image_url
    //             WHERE id = :id";
    //      $stmt = $pdo->prepare($sql);
    //      $stmt->bindParam(':title', $title);
    //      $stmt->bindParam(':description',$description);
    //      $stmt->bindParam(':content', $content);
    //      $stmt->bindParam(':image_url', $image_url);
    //      $stmt->bindParam(':category_id', $category_id);
    //      $stmt->bindParam(':id',$id);
    //     if ($stmt->execute()) {
    //         return true; 
    //     } else {
    //         echo "Une erreur est survenue lors de la mise à jour de l'article.";
    //         return false; 
    //     }
    // }
    
}

?>