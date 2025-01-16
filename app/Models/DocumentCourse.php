<?php 
namespace app\Models;
require_once dirname(__FILE__, 3).'/vendor/autoload.php';
use app\Config\Database;
use app\Models\Course;

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
}


?>
