<?php 
require_once dirname(__FILE__, 5) . '/vendor/autoload.php';
use app\Config\Database;
use app\Models\Course;

$conn = new Database();
$conction = $conn->getConnection();
$selct = new Course();
$courses = $selct->get_all__courses($conction);
$cours_id = $_GET['delet_id'] ?? null;
$id_active = $_GET['id_active'] ?? null;
$block_id = $_GET['block_id'] ?? null;


if($cours_id){
    $selct->delete_cours($conction,$cours_id);
    header("location: ./GestionContenus.php");
}
if($id_active){
    $selct->update_status($conction,$id_active);
    header("location: ./GestionContenus.php");
}
if($block_id){
    $selct->update_status_ban($conction,$block_id);
    header("location: ./GestionContenus.php");
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Gestion des contenus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

</head>
<body class="bg-gray-50">
  <?php include "../../layout/header.php" ?>

   
    <div class="flex flex-col md:flex-row">
        <!-- nav -->
         <?php include "../../layout/nav.php" ?>
        <section style="width:200rem;">
        <div class="container mx-auto px-4 py-12">
        <!-- Header Section -->
        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Gestion des Contenus</h1>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                + Créer un nouveau cours
            </button>
        </div>

        <!-- Filters and Search -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="col-span-1">
                <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Toutes les catégories</option>
                    <option>Développement Web</option>
                    <option>Design</option>
                    <option>Business</option>
                    <option>Marketing</option>
                </select>
            </div>
            <div class="col-span-1">
                <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Tous les statuts</option>
                    <option>Publié</option>
                    <option>Brouillon</option>
                    <option>En révision</option>
                </select>
            </div>
            <div class="col-span-2">
                <input type="search" 
                    placeholder="Rechercher un cours..." 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cours
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Catégorie
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Instructeur
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Prix
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Étudiants
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Course Row 1 -->
                         <?php foreach($courses as $course) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-20 w-28 flex-shrink-0">
                                        <img src="<?php echo $course['photo']?>" alt="" class="h-20 w-28 rounded-lg object-cover">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900"><?= $course['title'] ?></div>
                                        <div class="text-sm text-gray-500">20 leçons • 15h de contenu</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <?= $course['category_name'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Thomas Martin</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <?=$course['status'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?=$course['prix']?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                245
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                          
                            <a href="../courses/cours.php?cours_id=<?php echo $course['id']?>" class="text-gray-600 hover:text-gray-900">
                                <i class="fas fa-eye"></i> 
                            </a>

                            <a href="./GestionContenus.php?block_id=<?php echo $course['id']?>" class="text-blue-600 hover:text-blue-900">
                               <i class="fas fa-ban"></i> 
                            </a>
                            <!-- <a href="#" class="text-blue-600 hover:text-blue-900 active:text-blue-900"> -->
                            <a href="./GestionContenus.php?id_active=<?php echo $course['id']?>" class="text-green-600 hover:text-green-900">
                                <i class="fas fa-check-circle"></i> 
                            </a>
                            <a href="./GestionContenus.php?delet_id=<?php echo $course['id']?>" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash-alt"></i> 
                            </a>
                        </div>

                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Précédent
                        </button>
                        <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Suivant
                        </button>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Affichage de <span class="font-medium">1</span> à <span class="font-medium">3</span> sur <span class="font-medium">12</span> cours
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    Précédent
                                </button>
                                <button class="bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    1
                                </button>
                                <button class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    2
                                </button>
                                <button class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    3
                                </button>
                                <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    Suivant
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </section>
</body>
</html>