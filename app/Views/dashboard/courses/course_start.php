
<?php 
require_once dirname(__FILE__, 5) . '/vendor/autoload.php';
use app\Config\Database;
use app\Models\Enrollment;
use app\Models\Tags;

$conn = new Database();
$conction = $conn->getConnection();
$select = new Enrollment();
$cours_id = $_GET['cours_id'] ?? null;
$cours = $select->get_cours($conction,$cours_id);
$get_tags = new Tags();
$tags = $get_tags->course_tags($conction,$cours_id);
if (!empty($tags)) {
    foreach ($tags as $tag) {
        echo 'Course ID: ' . $tag['course_id'] . '<br>';
        echo 'Tag ID: ' . $tag['tag_id'] . '<br>';
    }
} else {
    echo 'No tags available.';
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenu du Cours - Vidéos et PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- En-tête -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="bg-blue-600 p-6 text-white">
                <h1 class="text-2xl font-bold mb-2">Contenu du Cours</h1>
                <p class="text-blue-100"><?= $cours['title'] ?></p>
            </div>
        </div>

        <!-- Contenu Dynamique -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <?php if($cours['type'] === 'video'): ?>
                <!-- Affichage de la vidéo -->
                <h2 class="font-bold text-gray-800 mb-4">Vidéo du cours</h2>
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-800"><?= $cours['title'] ?></h3>
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe 
                            class="w-full h-full" 
                            src="<?= $cours['content'] ?>" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                    <?php if(!empty($cours['description'])): ?>
                        <p class="mt-4 text-gray-600"><?= $cours['description'] ?></p>
                    <?php endif; ?>
                </div>
            <?php elseif($cours['type'] === 'document'): ?>
                <!-- Affichage du document -->
                <h2 class="font-bold text-gray-800 mb-4">Document du cours</h2>
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-800"><?= $cours['title'] ?></h3>
                    <div class="bg-gray-50 rounded-lg p-6 mt-4">
                        <div class="prose max-w-none">
                            <?= $cours['content'] ?>
                        </div>
                    </div>
                    <?php if(!empty($cours['document_url'])): ?>
                        <div class="mt-4">
                            <a 
                                href="<?= $cours['document_url'] ?>" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                                target="_blank"
                            >
                                Télécharger le document
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Section Ressources Supplémentaires -->
        <?php if(!empty($cours['additional_resources'])): ?>
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="font-bold text-gray-800 mb-4">Ressources Supplémentaires</h2>
            <?php foreach($cours['additional_resources'] as $resource): ?>
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-800"><?= $resource['title'] ?></h3>
                    <a href="<?= $resource['link'] ?>" class="text-blue-600 hover:underline" target="_blank">
                        <?= $resource['type'] === 'video' ? 'Regarder la vidéo' : 'Consulter la ressource' ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="font-bold text-gray-800 mb-4">Tags Associés</h2>
        <?php foreach ($tags as $tag): ?>
            <span class="px-3 py-1 bg-gray-200 text-gray-800 rounded-full text-sm">
                <?php echo $get_tags->get_tag($conction, $tag['tag_id'])?>
            </span>
        <?php endforeach; ?>
    </div>

    </div>
    <!-- Section des Tags -->




</body>
</html>

