<?php 
require_once dirname(__FILE__, 5) . '/vendor/autoload.php';
use app\Config\Database;
use app\Models\Course;

$conn = new Database();
$conction = $conn->getConnection();
$selct = new Course();
$cours_id = $_GET['cours_id'] ?? null;
var_dump($cours_id);


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
                <h1 class="text-2xl font-bold mb-2">Développement Web Frontend</h1>
                <p class="text-blue-100">Apprenez HTML, CSS et JavaScript</p>
            </div>

            <div class="p-6">
                <!-- Section instructeur -->
                <div class="flex items-center space-x-4 mb-6">
                    <img src="/api/placeholder/64/64" alt="Instructeur" class="w-16 h-16 rounded-full">
                    <div>
                        <h3 class="font-semibold text-gray-800">Marie Dubois</h3>
                        <p class="text-gray-600">Développeuse Senior Frontend</p>
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
                        <p class="text-gray-600">Débutant</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                        <h4 class="font-medium text-gray-800 mb-1">Langue</h4>
                        <p class="text-gray-600">Français</p>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Description du cours</h2>
                    <p class="text-gray-600 mb-4">
                        Ce cours complet vous permettra d'acquérir les compétences essentielles 
                        en développement web frontend. Vous apprendrez à créer des sites web 
                        interactifs et responsive en utilisant les technologies modernes.
                    </p>
                    
                    <h3 class="font-semibold text-gray-800 mb-2">Ce que vous apprendrez :</h3>
                    <ul class="space-y-2 text-gray-600 list-disc pl-5 mb-6">
                        <li>Les bases du HTML5 et CSS3</li>
                        <li>JavaScript et programmation interactive</li>
                        <li>Responsive design</li>
                        <li>Bonnes pratiques de développement</li>
                    </ul>
                </div>

                <!-- Prix et bouton d'inscription -->
                <div class="border-t pt-6">
                    <div class="text-3xl font-bold text-green-600 mb-4">
                        99,99 €
                    </div>
                    <button class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        S'inscrire maintenant
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
