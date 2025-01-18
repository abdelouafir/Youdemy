<?php 
require_once dirname(__FILE__, 3) . '/vendor/autoload.php';
use app\Config\Database;
use app\Models\Tags;

$conn = new Database();
$conction = $conn->getConnection();
$id = '';
$ins = new Tags();

// Récupération des données pour mise à jour
if (isset($_POST['update_id'])) {
    $id = $_POST['update_id'];
    $update = Tags::get_tag($conction, $id);
}

// Mise à jour des données
if (isset($_POST['tagName']) && !empty($_POST['update_id'])) {
    $id = $_POST['update_id'];
    $tag_update = $_POST['tagName'];

    $update_result = Tags::update_tag($conction, $id, $tag_update);

    if ($update_result) {
        echo htmlspecialchars($tag_update) . " mis à jour avec succès";
        header("location: ../Views/dashboard/admin/tags.php");
    } else {
        echo "Erreur lors de la mise à jour";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier le Tag</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Modifier le Tag</h1>

    <form action="./updateTag.php" method="POST">
      <!-- Champ caché pour l'ID -->
      <input type="hidden" name="update_id" value="<?= $id ?>">

      <div class="mb-4">
        <label for="tagName" class="block text-sm font-medium text-gray-700">Nom du Tag</label>
        <input 
          type="text" 
          id="tagName" 
          name="tagName" 
          value="<?= isset($update['name']) ? $update['name']    : '' ?>" 
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-900" 
          placeholder="Entrez le nom du tag" 
          required
        >
      </div>
      <div class="flex justify-end space-x-4">
        <a href="/tags" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 focus:outline-none">Annuler</a>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 focus:outline-none">Sauvegarder</button>
      </div>
    </form>
  </div>
</body>
</html>
