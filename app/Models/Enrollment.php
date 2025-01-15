<?php 
namespace app\Models;
require_once dirname(__FILE__, 3) . '/vendor/autoload.php';
use app\Models\user;
use PDO;
use app\Config\Database;

$conn = new Database();
$conction = $conn->getConnection();

class Enrollment extends user {


    
}

?>