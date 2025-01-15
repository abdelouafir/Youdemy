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
