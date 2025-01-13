<?php 
namespace app\category;
use pdo;
class category {

    public static function insert($tableName, $columns, $values) {
        $result = category::insert($tableName, $columns, $values);
        if ($result == true) {
            return $result;
        } else {
            echo "Record does not insert try again";
        }
       }

       public static function create_category($pdo,$name) {
        $sql = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$name]);
      }
      public static function delete_category($pdo, $id) {
        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
      }
      public static function update_category($pdo, $id ,$new_title) {
        $stmt = $pdo->prepare("UPDATE categories SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $new_title, PDO::PARAM_STR);  
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();  
    }
    
    public function get_categories($pdo) {
      $stmt = $pdo->prepare("SELECT * FROM categories");
      $stmt->execute();  
      return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    public static function get_category($pdo, $id) {
      $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
      $stmt->execute(); 
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function  total_categorys($pdo){
      $sql = "SELECT COUNT(*) as 'total' FROM categories";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $resolte = $stmt->fetch(PDO::FETCH_ASSOC);
      return $resolte['total'];
    }
}
?>