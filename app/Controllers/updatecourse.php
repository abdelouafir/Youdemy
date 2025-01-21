<?php 
// id de update 
require_once dirname(__FILE__, 3) . '/vendor/autoload.php';

use app\Config\Database;
use app\Models\Enrollment;
use app\Models\Tags;
use app\Models\category;
use app\Controllers\CourseManager;
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


$conn = new Database();
$course = new Enrollment();
$get_tags = new Tags();
$get_category = new category();
$conction = $conn->getConnection();
$categorys = $get_category->get_categories($conction);

$tags = $get_tags->get_tags($conction);
$conction = $conn->getConnection();
$course_mangement = new CourseManager($conction);
$update_cours = $course->get_cours($conction,$id);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez si l'ID du cours est présent
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        exit; 
    }
  
    
    $type = $_POST['type'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $content = ($type === 'video') ? ($_POST['video-url'] ?? '') : ($_POST['document'] ?? '');
    $tags_insert = $_POST['tags'] ?? [];
    $duration = $_POST['duration'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = (float)($_POST['price'] ?? 0);
    $image_url = $_POST['image-url'] ?? '';
    $level = $_POST['level'] ?? '';
    $status = 1;  

    
    $errors = [];

    if (empty($title)) {
        $errors['title'] = "Le titre est requis.";
    }

    if (empty($description)) {
        $errors['description'] = "La description est requise.";
    }

    if (!in_array($type, ['video', 'document'])) {
        $errors['type'] = "Le type de contenu est invalide.";
    }

    if (empty($content)) {
        $errors['content'] = $type === 'video' ? "L'URL de la vidéo est requise." : "Le contenu du document est requis.";
    }

    if (!is_array($tags_insert)) {
        $errors['tags'] = "Les tags sont invalides.";
    }


    if (empty($category)) {
        $errors['category'] = "La catégorie est requise.";
    }

    if (empty($price) || !is_numeric($price) || $price < 0) {
        $errors['price'] = "Le prix doit être un nombre positif.";
    }

    if (empty($image_url) || !filter_var($image_url, FILTER_VALIDATE_URL)) {
        $errors['image-url'] = "Une URL valide pour l'image est requise.";
    }

    if (!in_array($level, ['debutant', 'intermediaire', 'avance', 'expert'])) {
        $errors['level'] = "Le niveau sélectionné est invalide.";
    }

    var_dump($errors);

    if (empty($errors)) {
        echo "hellow worled";
        $get_tags->delet_all_tags($conction, $id);

        $course_mangement->update_cours($type, $id, $title, $description, $content, $image_url, $status, $price, $level, $category, $price);

      
        $get_tags->insert_tag($conction, $id, $tags_insert);

         header('location: ../Views/dashboard/Enseignant/home.php');
    } 
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
     <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>


    <script>
       function updateInputFields() {
        const type = document.getElementById('type').value;
        const videoInput = document.getElementById('video-input');
        const documentTextarea = document.getElementById('document-textarea'); // تم تصحيح الـ id

        if (type === 'video') {
            videoInput.style.display = 'block';
            documentTextarea.style.display = 'none';
        } else if (type === 'document') {
            videoInput.style.display = 'none';
            documentTextarea.style.display = 'block';
        }
    }

    </script>
</head>
<body class="bg-gray-100 min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="bg-blue-600 p-6 text-white">
                <h1 class="text-2xl font-bold">Ajouter un nouveau cours</h1>
                <p class="text-blue-100">Remplissez les informations du cours</p>
            </div>
        </div>

        <!-- Form -->
        <form action="./updatecourse.php" method="POST" class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- General Information -->
            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Informations générales</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Titre du cours</label>
                        <input type="text" name="title" class="w-full px-4 py-2 border rounded-lg" placeholder="Titre" value="<?php echo $update_cours['title'] ?>">
                        <?php if (isset($errors['title'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['title'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                        <select name="category" class="w-full px-4 py-2 border rounded-lg">
                            <?php foreach ($categorys as $category) {?>
                            <option value="<?php echo $category['id']?>"><?php echo $category['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description courte</label>
                        <input type="text" name="description" class="w-full px-4 py-2 border rounded-lg" placeholder="Description courte" value="<?php echo $update_cours['description'] ?>">
                        <?php if (isset($errors['description'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['description'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                    <select id="tags" name="tags[]" multiple class="w-full px-4 py-2 border rounded-lg">
                        <?php foreach($tags as $tag) {?>
                        <option value="<?php echo $tag['id'] ?>"><?php echo $tag['name'] ?></option>
                        <?php } ?>
                       
                    </select>

                        <p class="text-sm text-gray-500 mt-1">Maintenez Ctrl (Windows) ou Cmd (Mac) pour sélectionner plusieurs tags</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Niveau</label>
                        <select name="level" class="w-full px-4 py-2 border rounded-lg">
                            <option value="debutant">Débutant</option>
                            <option value="intermediaire">Intermédiaire</option>
                            <option value="avance">Avancé</option>
                            <option value="expert">Expert</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type de contenu</label>
                        <select id="type" name="type" class="w-full px-4 py-2 border rounded-lg" onchange="updateInputFields()">
                            <option value="video">Vidéo</option>
                            <option value="document">Document</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Dynamic Content Input -->

            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Contenu</h2>
                
                <!-- Video Input -->
                <div id="video-input" style="display: block;">
                    <label class="block text-sm font-medium text-gray-700 mb-1">URL de la vidéo</label>
                    <input type="text" name="video-url" class="w-full px-4 py-2 border rounded-lg" placeholder="https://exemple.com/video.mp4" value="<?php echo $update_cours['content'] ?>">
                    <?php if (isset($errors['type'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['type'] ?></p>
                        <?php endif; ?>
                </div>
                
                <!-- Document Textarea -->
                <div id="document-textarea" style="display: none;"> 
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description complète du document</label>
                    <textarea name="document" rows="4" class="w-full px-4 py-2 border rounded-lg" placeholder="Description complète"><?php echo $update_cours['content']; ?></textarea>
                    <?php if (isset($errors['document'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['document'] ?></p>
                        <?php endif; ?>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="p-6 border-b">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix (€)</label>
                        <input type="number" name="price" class="w-full px-4 py-2 border rounded-lg" placeholder="Prix">
                        <?php if (isset($errors['price'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['price'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Image URL -->
            <div class="p-6 border-b">
                <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                <input type="url" name="image-url" class="w-full px-4 py-2 border rounded-lg" placeholder="https://exemple.com/image.jpg" value="<?php echo $update_cours['photo'] ?>">
                <?php if (isset($errors['image-url'])): ?>
                    <p class="text-red-500 text-sm"><?= $errors['image-url'] ?></p>
                <?php endif; ?>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!-- Submit Button -->
            <div class="p-6 bg-gray-50 flex justify-end space-x-3">
                <button type="reset" class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">Annuler</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">update le cours</button>
            </div>
        </form>
    </div>
    <script>
    new TomSelect("#tags", {
        maxItems: 10,
        create: false,
        placeholder: 'Select tags...',
    });
   </script>
   <script src="../public/js/script.js"></script>
</body>
</html>