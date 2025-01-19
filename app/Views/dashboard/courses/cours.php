<?php 
require_once dirname(__FILE__, 5) . '/vendor/autoload.php';
use app\Config\Database;
use app\Models\Enrollment;

$conn = new Database();
$conction = $conn->getConnection();
$select = new Enrollment();
$cours_id = $_GET['cours_id'] ?? null;
if($cours_id != null){
    $cours = $select->get_cours($conction,$cours_id);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Cours</title>
    <!-- Lien vers le fichier CSS de Tailwind (correct) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- En-tête du cours -->
            <div class="bg-blue-600 p-6 text-white">
                <h1 class="text-2xl font-bold mb-2"><?=$cours['title']?></h1>
                <p class="text-blue-100"><?=$cours['description']?></p>
            </div>

            <div class="p-6">
                <!-- Section instructeur -->
                <div class="flex items-center space-x-4 mb-6">
                    <img src="<?= $cours['photo']?>" alt="Instructeur" class="w-16 h-16 rounded-full">
                    <div>
                        <h3 class="font-semibold text-gray-800"><?= $cours['username']?></h3>
                        <p class="text-gray-600"><?=$cours['email']?></p>
                    </div>
                </div>

                <!-- Caractéristiques du cours -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <h4 class="font-medium text-gray-800 mb-1">Durée</h4>
                        <p class="text-gray-600">12 semaines</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <h4 class="font-medium text-gray-800 mb-1">Niveau</h4>
                        <p class="text-gray-600"><?=$cours['Niveau']?></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <h4 class="font-medium text-gray-800 mb-1">category</h4>
                        <p class="text-gray-600"><?= $cours['category_name']?></p>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Description du cours</h2>
                    <p class="text-gray-600 mb-4">
                        <?= $cours['description']?>
                    </p>
                    

                </div>

                <!-- Prix et bouton d'inscription -->
                <div class="border-t pt-6">
                    <div class="text-3xl font-bold text-green-600 mb-4">
                        <?= $cours['prix'].'dh'?>
                    </div>
                    <a href="./course_start.php?cours_id=<?php echo $cours_id ?>" 
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium text-center block">
                            S'inscrire maintenant
                    </a>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
