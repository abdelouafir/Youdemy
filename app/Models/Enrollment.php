<?php 
namespace app\Models;
require_once dirname(__FILE__, 3) . '/vendor/autoload.php';
use app\Models\user;
use app\Config\Database;

$conn = new Database();
$conction = $conn->getConnection();

class Enrollment extends user {

      public function register($pdo) {
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) 
                VALUES (:username, :email, :password_hash)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $this->user_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password_hash', $passwordHash);
    
        if ($stmt->execute()) {
            echo 'Utilisateur ajouté avec succès.';
        } else {
            echo 'Échec de l ajout de lutilisateur.';
        }
    }

    
}

?>