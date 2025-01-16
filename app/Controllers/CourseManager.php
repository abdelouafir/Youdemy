<?php
namespace app\Controllers;
// require_once dirname(__FILE__, 3).'/vendor/autoload.php';
use app\Models\Course;
use app\Models\VideoCourse;
use app\Config\Database;
use app\Models\DocumentCourse;

    $conn = new Database();
    $conction = $conn->getConnection();

class CourseManager {
    public $conction;

    public function __construct($conction)
    {
        $this->conction = $conction;
    }
    public function createCourse($type,$title,$description,$videoLink,$photo,$status,$price,$level,$teacherId,$category) {
    
        if ($type === 'video') {
             $VideoCourse = new VideoCourse($title, $description,$videoLink,$photo, $status,$level,$teacherId,$category);
             $id_cours = $VideoCourse->add_cours($this->conction);
            return $id_cours;
        } elseif ($type === 'document') {
            $documont_cours = new DocumentCourse($title, $description, $photo, $status, $price, $level, $teacherId,$videoLink,$category);
            $documont_cours->add_cours($this->conction);
        } else {
            return "les type de doner no coerct";
        }
    }
}
?>
