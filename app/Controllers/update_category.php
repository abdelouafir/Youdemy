<?php 
require_once dirname(__FILE__, 3) . '/vendor/autoload.php';
use app\Config\Database;
use app\Models\category;

$conn = new Database();
$conction = $conn->getConnection();
$conn = new Database();
$conction = $conn->getConnection();
$id='';
$ins = new category();

if (isset($_POST['category_id'])) {
    $id= $_POST['category_id'];
    $update = category::get_category($conction, $id);
    
}

if (isset($_POST['title']) && !empty($id)) {
  var_dump($id);
    $category_id = $_POST['title'];
    $update_result = category::update_category($conction, $id, $category_id);
    if ($update_result) {
        echo $category_id . "apdetad";
        header("location: ../Views/dashboard/admin/category.php");

    } else {
        echo "erore";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un Tag</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

  <div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-8">Ajouter un Nouveau Tag</h1>

    <!-- Formulaire pour ajouter un nouveau tag -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
      <h2 class="text-2xl font-semibold text-gray-700 mb-4">modifaucation un category</h2>
      <form action="./update_category.php" method="POST">
      <input type="hidden" name="category_id" value="<?= isset($id) ? $id : '' ?>">

        <div class="mb-4">
          <label for="title" class="block text-gray-600 font-medium">Nom du Tag:</label>
          <input type="text" id="title" name="title" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?=  $update['name'] ?>">
        </div>
        <button type="submit" name="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Update</button>
      </form>
    </div>
  </div>

</body>
</html>














