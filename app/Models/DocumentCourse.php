<?php 
namespace app\Models;
require_once dirname(__FILE__, 3).'/vendor/autoload.php';
use app\Config\Database;
use app\Models\Course;
use PDOException;

$conn = new Database();
$conction = $conn->getConnection();

class DocumentCourse extends Course {
    private string $documentPath;

    public function __construct( $title, $description,$videoLink, $photo, $status, $level, $teacherId,$category,$type ) {
        parent::__construct($title, $description,$videoLink,$photo, $status, $level, $teacherId,$category,$type);
        $this->documentPath = $videoLink;
    }

    public function getDocumentPath(): string {
        return $this->documentPath;
    }

    public function displayType(): string {
        return "Document Course";
    }

    public function add_cours($pdo) {
        try {
            $sql = "INSERT INTO courses (title, description, content, photo, video_link,teacher_id,category_id,type)
                    VALUES (:title, :description, :content, :photo, :video_link, :teacher_id,:category_id,:type)";
            
            $stmt = $pdo->prepare($sql);
    

            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':photo', $this->photo);
            $stmt->bindParam(':teacher_id', $this->enseignant);
            $stmt->bindParam(':category_id', $this->category);
            $stmt->bindParam(':type',$this->type);
         
            $stmt->bindParam(':video_link', $this->documentPath); 

            // Exécuter la requête
            if ($stmt->execute()) {
                $lastInsertedId = $pdo->lastInsertId();
                return $lastInsertedId;  
            } else {
                return null;  
            }
        } catch (PDOException $e) {
            echo "Une erreur est survenue lors de l'ajout du cours : " . $e->getMessage();
            return null;
        }
    }

    public function updateCurse($pdo, $id) {
        try {
            $sql = "UPDATE courses 
                    SET type = :type, title = :title, description = :description, content = :content, category_id = :category_id, photo = :image_url
                    WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':image_url', $this->photo);
            $stmt->bindParam(':category_id', $this->category);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':type',$this->type);
            if ($stmt->execute()) {
                return true; 
            } else {
                return false;  
            }
        } catch (PDOException $e) {
            echo "Une erreur est survenue lors de la mise à jour de l'article : " . $e->getMessage();
            return false;
        }
    }
}


?>
