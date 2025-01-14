<?php 
require_once dirname(__FILE__, 4) . '/vendor/autoload.php';
use app\Config\Database;
use app\Models\Course;

$conn = new Database();
$inser = new Course;

$conction = $conn->getConnection();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $title = $_POST['title'];
   $descript = $_POST['description'];
   $ducomont = $_POST['documont'];
   $dueree = $_POST['dueree'];
   $prix = $_POST['prix'];
   $image_url = $_POST['image-url'];
   $video_url = $_POST['video-url'];
   $inser->add_cours($conction,$title,$descript,$ducomont,3,1,$video_url,$image_url,$prix);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un cours</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100 min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- En-tête -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="bg-blue-600 p-6 text-white">
                <h1 class="text-2xl font-bold">Ajouter un nouveau cours</h1>
                <p class="text-blue-100">Remplissez les informations du cours</p>
            </div>
        </div>

        <!-- Formulaire -->
        <form action="./create.php" method="POST" class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Informations de base -->
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Informations générales</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Titre du cours
                        </label>
                        <input type="text" 
                               name="title"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Ex: Développement Web Frontend">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description courte
                        </label>
                        <input type="text" 
                               name="description"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Bref aperçu du cours">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            ducomont
                        </label>
                        <textarea rows="4" 
                                 name="documont"
                                  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Description complète du cours"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Niveau
                            </label>
                            <select class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>Débutant</option>
                                <option>Intermédiaire</option>
                                <option>Avancé</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Durée (en heures)
                            </label>
                            <input type="number" 
                                    name="dueree"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Ex: 12">
                                   
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prix et catégorie -->
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Prix et catégorie</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Prix (€)
                        </label>
                        <input type="number" 
                              name="prix"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Ex: 99.99">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Catégorie
                        </label>
                        <select class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>Développement Web</option>
                            <option>Design</option>
                            <option>Marketing</option>
                            <option>Business</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Image du cours -->
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Image du cours</h2>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <div class="space-y-2">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="text-sm text-gray-600">
                            <label for="image-url" class="block text-gray-700">Entrez l'URL de l'image</label>
                            <input type="url" id="image-url" name="image-url"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="https://exemple.com/image.jpg">
                        </div>
                        <p class="text-xs text-gray-500">Entrez une URL d'image valide (PNG, JPG)</p>
                    </div>
                </div>
            </div>

            <!-- Lien vidéo -->
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Lien vidéo</h2>
                <div>
                    <label for="video-url" class="block text-sm font-medium text-gray-700 mb-1">
                        URL de la vidéo
                    </label>
                    <input type="url" id="video-url" name="video-url"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="https://exemple.com/video.mp4" oninput="updateVideoPreview()">
                    <p class="text-xs text-gray-500 mt-1">Entrez un lien vidéo (YouTube, Vimeo, etc.)</p>
                </div>
                <div id="video-preview" class="mt-4 text-center">
                    <!-- Aperçu dynamique de la vidéo -->
                    Aperçu vidéo non disponible
                </div>
            </div>

            <!-- Boutons -->
            <div class="p-6 bg-gray-50 flex justify-end space-x-3">
                <button type="button" 
                        class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                    Annuler
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Créer le cours
                </button>
            </div>
        </form>
    </div>
</body>
</html>
