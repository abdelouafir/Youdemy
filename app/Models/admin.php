<?php
namespace app\Models;
use pdo;
require_once dirname(__FILE__, 3) . '/vendor/autoload.php';

use app\Models\user;


class admin extends user {

    public function get_all_users ($pdo){
        $sql = "SELECT id,username,role,email,password FROM users";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

}

?>