<?php 
namespace app\Models;
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
    echo "hello woled";
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

public static function course_tags($pdo, $id) {
  $stmt = $pdo->prepare("SELECT * FROM course_tags WHERE course_id = :id");

  $stmt->bindParam(':id', $id); 
  $stmt->execute(); 

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function totale_tags($pdo){
  $sql = "SELECT COUNT(*) AS 'totale' FROM tags";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result['totale'];
}
 public function insert_tag($pdo,$cours_id,$tag_id){
  $sql = "INSERT INTO course_tags (course_id,tag_id)
  VALUES (:course_id, :tag_id)";
  $stmt = $pdo->prepare($sql);
  foreach ($tag_id as $tag_id) {
     $stmt->bindParam(':course_id', $cours_id);
     $stmt->bindParam(':tag_id', $tag_id);
     if (!$stmt->execute()) {
         echo "Error occurred while adding tag ID: " . $tag_id;
         return false; 
     }
 }
 return true;
}
public static function get_un_tag($pdo, $id) {
  $stmt = $pdo->prepare("SELECT * FROM tags WHERE id = :id");
  $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
  $stmt->execute(); 
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function get_tag($pdo, $id) {

  $sql = "SELECT name FROM tags WHERE id = :id";
  $stmt = $pdo->prepare($sql);

  $stmt->bindParam(':id', $id);

  $stmt->execute();


  $tag = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($tag) {
      return $tag['name']; 
  }
  return null;
}

public function delet_all_tags($pdo, $id) {
  $sql = "DELETE FROM course_tags WHERE course_id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $id);
  return $stmt->execute();
}

}


?>
