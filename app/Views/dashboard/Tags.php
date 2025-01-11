
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Tags</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

  <div class="container mx-auto p-6">
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
       
            <td class="px-4 py-2"><?=$tag['id'] ?></td>
            <td class="px-4 py-2"><?=$tag['name'] ?></td>
            <td class="px-4 py-2 text-center">
              <form action="/ruturn/update.php" method="POST" class="inline-block">
              <input type="hidden" name="update_id" value="<?php echo $tag['id']; ?>">
              <button type="submit" class="ml-2 bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">Mettre à jour</button>
              </form>
              <form action="./tags.php" method="POST" class="inline-block ml-2">
                 <input type="hidden" name="id" value="<?php echo $tag['id']; ?>">
                 <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Supprimer</button>
              </form>
            </td>
          </tr>
          <!-- Ajouter plus de lignes selon les tags existants -->

        </tbody>
      </table>
    </div>

    <!-- Formulaire pour ajouter un nouveau tag -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
      <h2 class="text-2xl font-semibold text-gray-700 mb-4">Ajouter un Nouveau Tag</h2>
      <form action="./tags.php" method="POST">
        <div class="mb-4">
          <label for="name" class="block text-gray-600 font-medium">Nom du Tag:</label>
          <input type="text" id="name" name="title" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Ajouter</button>
      </form>
    </div>
  </div>

</body>
</html>
















