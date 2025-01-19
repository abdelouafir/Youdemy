<?php 
namespace app\Models;
use PDO;

class Login {
    public function login($pdo, $email, $password) {
        $sql = "SELECT * FROM USERS WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user) {
            if (password_verify($password, $user['password'])) {
                echo "corcted";
                session_start();
                $_SESSION['user'] =  $user;
                header("location: ../auth/gestion_role.php");
            } else {
                echo "no corected";
                echo $user['password'];
            }
        } else {
            return [
                'status' => false,
                'message' => 'User not found'
            ];
        }
    }
}
?>