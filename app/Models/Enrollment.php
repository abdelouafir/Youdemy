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
    public function get_all_mycours($pdo,$id,$limit, $offset) {
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
        WHERE courses.teacher_id = :id
        LIMIT $limit OFFSET $offset;
        ";
        
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
  

    public function get_all_courses_activer_paginasion($pdo, $limit, $offset) {
        $sql = "SELECT 
               courses.id,
               courses.title,
               courses.content,
               courses.description,
               courses.photo,
               courses.prix,
               courses.status,
               courses.video_link,
               courses.teacher_id,
               users.username,
               users.email,
               categories.name AS category_name
            FROM courses
            JOIN users ON users.id = courses.teacher_id
            JOIN categories ON categories.id = courses.category_id
            WHERE courses.status = 'active'
            LIMIT :limit OFFSET :offset"; 
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
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


public function toutal_cours ($pdo,$id){
    $sql = "SELECT count(*) AS 'toutal_student' FROM courses
    WHERE teacher_id = $id 
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['toutal_student'];
}
public function toutal_cours_active ($pdo,$id){
    $sql = "SELECT count(*) AS 'toutal_student' FROM courses
    WHERE teacher_id = $id and status != 'attente'
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['toutal_student'];
}

public function toutal_cours_active_ ($pdo){
    $sql = "SELECT count(*) AS 'toutal_student' FROM courses
    WHERE status != 'attente'
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['toutal_student'];
}

public function toutal_cours_attonte($pdo, $id) {
    $sql = "
    SELECT COUNT(*) AS toutal_student 
    FROM courses 
    WHERE teacher_id = :id AND status = 'attente'
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return (int)$result['toutal_student']; 
}

public function toutal_cours_block($pdo, $id) {
    $sql = "
    SELECT COUNT(*) AS toutal_student 
    FROM courses 
    WHERE teacher_id = :id AND status = 'block'
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return (int)$result['toutal_student']; 
}

public function totalélèvesr($pdo,$id) {
    $sql = "
    SELECT 
        teacher_id, 
        COUNT(enrollment.student_id) AS total_students 
    FROM 
        courses 
    LEFT JOIN 
        enrollment ON courses.id = enrollment.course_id 
    WHERE 
       courses.id = :id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id); 
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return (int)$result['total_students']; 
}

public function getTotalStudentsPerCourse($pdo, $id) {
    $sql = "
    SELECT 
        COUNT(enrollment.student_id) AS total_etud
    FROM 
        courses
    LEFT JOIN 
        enrollment ON courses.id = enrollment.course_id
    WHERE 
        courses.id = :id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id); 
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return (int)$result['total_etud']; 
}
public function total_eleve($pdo, $id) {
    $sql = "
    SELECT 
        COUNT(DISTINCT student_id) AS total_etud
    FROM 
        enrollment
    WHERE 
        Enseignant_id = :id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id); 
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int)$result['total_etud'];
   }
}

?>