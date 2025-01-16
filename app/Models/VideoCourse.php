<?php 
namespace app\Models;
require_once dirname(__FILE__, 3).'/vendor/autoload.php';
use app\Config\Database;
use app\Models\Course;
use PDOException;
$conn = new Database();
$conction = $conn->getConnection();



class VideoCourse extends Course {
    private string $videoLink;

    public function __construct( $title, $description,$videoLink, $photo, $status, $level, $teacherId ) {
        parent::__construct($title, $description,$videoLink,$photo, $status, $level, $teacherId);
        $this->videoLink = $videoLink;
    }

    public function getVideoLink(): string {
        return $this->videoLink;
    }
    public function displayType(): string {
        return "Video Course";
    }

    public function add_cours($pdo) {
        try {
            $sql = "INSERT INTO courses (title, description, content, photo, video_link,teacher_id)
                    VALUES (:title, :description, :content, :photo, :video_link, :teacher_id)";
            
            $stmt = $pdo->prepare($sql);
    

            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':photo', $this->photo);
            $stmt->bindParam(':teacher_id', $this->enseignant);

            // $stmt->bindParam(':prix', $this->prix); 
            $stmt->bindParam(':video_link', $this->videoLink); 

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
    
}                  

?>
