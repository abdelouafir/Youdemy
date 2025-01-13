<?php 
namespace app\Controllers;
use pdo;
class Tags {

  private $id;
  public static function insert($tableName, $columns, $values) {
    $result = Tags::insert($tableName, $columns, $values);
    if ($result == true) {
        return $result;
    } else {
        echo "Record does not insert try again";
    }
   }
  
   
   public static function create_tags($pdo,$name) {
    $sql = "INSERT INTO tags (name) VALUES (?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$name]);
  }
  public static function delete_tage($pdo, $id) {
    $sql = "DELETE FROM tags WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id]);
  }
  public static function update_tag($pdo, $id ,$new_title) {
    $stmt = $pdo->prepare("UPDATE tags SET name = :name WHERE id = :id");
    $stmt->bindParam(':name', $new_title, PDO::PARAM_STR);  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();  
}

public function setvalue($id){
   $this->id = $id;
}

public function getvalue(){
  return $this->id;
}
public function get_tags($pdo) {
  $stmt = $pdo->prepare("SELECT * FROM tags");
  $stmt->execute();  
  return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

public static function get_tag($pdo, $id) {
  $stmt = $pdo->prepare("SELECT * FROM tags WHERE id = :id");
  $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
  $stmt->execute(); 

  return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function totale_tags($pdo){
  $sql = "SELECT COUNT(*) AS 'totale' FROM tags";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['totale'];
}
}

?>
