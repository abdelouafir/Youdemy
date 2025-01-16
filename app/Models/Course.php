<?php 
namespace app\Models;
use pdo;
use PDOException;
class Course {
    protected string $title;
    protected string $description;
    protected string $content;
    protected string $photo;
    protected string $status;
    protected float $prix;
    protected string $niveau;
    protected string $enseignant;
    protected string $student;
    // protected string $teacher_id;

    
    public function __construct($title,$descreption,$countent,$photo,$status,$niveau,$enseignant)
    {
        $this->title = $title;
        $this->enseignant = $enseignant;
        $this->description = $descreption;
        $this->content = $countent;
        $this->photo = $photo;
        $this->status = $status;
        // $this->prix = $prix;
        $this->niveau = $niveau;
    }
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
    

    // public function add_cours($pdo, $title, $description, $content, $category_id, $user, $video_link, $photo, $prix) {
    //     try {
    //         $sql = "INSERT INTO courses (title, description, content, category_id, teacher_id, video_link, photo, prix)
    //                 VALUES (:title, :description, :content, :category_id, :author_id, :video_link, :photo, :prix)";
    //         $stmt = $pdo->prepare($sql);
    
    //         $stmt->bindParam(':title', $title);
    //         $stmt->bindParam(':description', $description);
    //         $stmt->bindParam(':content', $content);
    //         $stmt->bindParam(':category_id', $category_id);
    //         $stmt->bindParam(':author_id', $user);
    //         $stmt->bindParam(':video_link', $video_link);
    //         $stmt->bindParam(':photo', $photo);
    //         $stmt->bindParam(':prix', $prix);
    
    //         if ($stmt->execute()) {
    //             $lastInsertedId = $pdo->lastInsertId();
    //             return $lastInsertedId; 
    //         } else {
    //             return null; 
    //         }
    //     } catch (PDOException $e) {
    //         echo "Une erreur est survenue lors de l'ajout du cours : " . $e->getMessage();
    //         return null;
    //     }
    // }
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

}
?>
