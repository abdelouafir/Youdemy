<?php
namespace app\Models;
use pdo;
use PDOException;
require_once dirname(__FILE__, 3) . '/vendor/autoload.php';
use app\Models\user;
class admin extends user {

    public function get_all_users ($pdo){
        $sql = "SELECT id,username,role,email,password,status FROM users";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function delete_user ($pdo,$id){
            $sql = "DELETE FROM users WHERE id = :id";
        
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
            try {
                return $stmt->execute();
            } catch (PDOException $e) {
                error_log("Erreur : " . $e->getMessage());
                return false;
            }
        }
        public function update_status($pdo, $id) {
            $status = 'active';
            $sql = "UPDATE users 
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
            $status = 'block';
            $sql = "UPDATE users 
                    SET status = :status
                    WHERE id = :id";
        
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $valur = $stmt->execute(); 
            print_r($valur);
            return $valur;
        }

        public function toutal_users ($pdo){
            $sql = "SELECT count(*) AS 'toutal_student' FROM users";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['toutal_student'];
        }
        public function toutal_student ($pdo){
            $sql = "SELECT count(*) AS 'toutal_student' FROM users WHERE role = 'student'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['toutal_student'];
        }
        public function toutal_enseignant ($pdo){
            $sql = "SELECT count(*) AS 'toutal_student' FROM users WHERE role = 'Enseignant'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['toutal_student'];
        }
        public function toutal_admin ($pdo){
            $sql = "SELECT count(*) AS 'toutal_student' FROM users WHERE role = 'admin'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['toutal_student'];
        }
        public function toutal_cours ($pdo){
            $sql = "SELECT count(*) AS 'toutal_student' FROM courses";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['toutal_student'];
        }

       
    }
    


?>