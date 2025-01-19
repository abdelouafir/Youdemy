<?php
require_once dirname(__FILE__, 5).'/vendor/autoload.php';
use app\Config\Database;
use app\Models\Tags;

session_start();
        
$data = $_SESSION['user'] ;
if($data){
    if($data['role'] != 'admin'){
        header('location: ../../auth/login.php');
    }

}

$conn = new Database();
$conction = $conn->getConnection();
$tag = new Tags();
$tags = $tag->get_tags($conction);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'])) {
  $tags = $_POST['title']; 
  $insert = Tags::create_tags($conction, $tags);;
  header("location: ./tags.php");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
  $id = $_POST['id']; 
  $delete = tags::delete_tage($conction,$id);
  header("location: ./tags.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Tags</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100 font-sans text-gray-800">
<?php include "../../layout/header.php" ?>

<div class="flex flex-col md:flex-row">
<?php include "../../layout/nav.php" ?>
<div class="container mx-auto p-6 py-14">
    <h1 class="text-3xl font-bold text-center mb-8">Gestion des Tags</h1>

    <!-- Tableau des Tags -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
      <h2 class="text-2xl font-semibold text-gray-700 mb-4">Liste des Tags</h2>
      <table class="min-w-full table-auto">
        <thead>
          <tr class="bg-gray-200">
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Nom du Tag</th>
            <th class="px-4 py-2 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Exemple de Tags -->
          <?php foreach($tags as $tag){?>
            <td class="px-4 py-2"><?=$tag['id'] ?></td>
            <td class="px-4 py-2"><?=$tag['name'] ?></td>
            <td class="px-4 py-2 text-center">
              <form action="../../../Models/updateTag.php" method="POST" class="inline-block">
              <input type="hidden" name="update_id" value="<?php echo $tag['id']; ?>">
              <button type="submit" class="ml-2 text-white py-2 px-3 rounded hover:bg-yellow-600">
              <i class="fa-solid fa-pen-to-square" style="color: #0b4ec1;"></i>
              </button>             
             </form>
              <form action="./tags.php" method="POST" class="inline-block ml-2">
                 <input type="hidden" name="id" value="<?php echo $tag['id']; ?>">
                 <button type="submit" class="text-red-500 py-1 px-3 rounded hover:text-red-600">
                 <i class="fas fa-trash-alt"></i>
                 </button>
              </form>
            </td>
          </tr>
          <!-- Ajouter plus de lignes selon les tags existants -->
          <?php }?>
        </tbody>
      </table>
    </div>

    <!-- Formulaire pour ajouter un nouveau tag -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
      <h2 class="text-2xl font-semibold text-gray-700 mb-4">Ajouter un Nouveau Tag</h2>
      <form action="./Tags.php" method="POST">
        <div class="mb-4">
          <label for="name" class="block text-gray-600 font-medium">Nom du Tag:</label>
          <input type="text" id="name" name="title" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"> 
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Ajouter</button>
      </form>
    </div>
  </div>
</div>


</body>
</html>
















