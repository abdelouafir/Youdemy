<?php 
namespace app\Models;
use PDO;

class User {
    protected $user_name;
    protected $email;
    protected $password;
    protected $role;

    // Constructeur
    public function __construct($user_name, $email, $password, $role)
    {
        $this->user_name = $user_name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

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

    public function login($pdo, $email, $password) {
        $sql = "SELECT * FROM USERS WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user) {
            if (password_verify($password, $user['password_hash'])) {
                echo "corcted";
                session_start();
                $_SESSION['user'] =  $user;
            } else {
                echo "no corected";
                echo $user['password_hash'];
            }
        } else {
            return [
                'status' => false,
                'message' => 'User not found'
            ];
        }
    }


    // Getters
    public function get_name() {
        return $this->user_name;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_password() {
        return $this->password;
    }

    public function get_role() {
        return $this->role;
    }
}
?>
