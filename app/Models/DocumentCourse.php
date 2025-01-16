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

    public function __construct(
        string $title,
        string $description,
        string $photo,
        string $status,
        float $price,
        string $level,
        int $teacherId,
        string $documentPath
    ) {
        parent::__construct($title, $description, $photo, $status, $price, $level, $teacherId);
        $this->documentPath = $documentPath;
    }

    public function getDocumentPath(): string {
        return $this->documentPath;
    }

    public function displayType(): string {
        return "Document Course";
    }

    public function add_cours($pdo) {
        try {
            
            $sql = "INSERT INTO courses (title, description, content, photo,teacher_id)
                    VALUES (:title, :description, :content, :photo, :teacher_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':photo', $this->photo);
            $stmt->bindParam(':teacher_id', $this->enseignant);

            // $stmt->bindParam(':prix', $this->prix); 
            $stmt->bindParam(':content', $this->documentPath); 
    
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
