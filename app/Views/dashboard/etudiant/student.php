<?php 
require_once dirname(__FILE__, 5) . '/vendor/autoload.php';
use app\Config\Database;
use app\Models\Enrollment;
use app\Models\User;

$conn = new Database();
$conction = $conn->getConnection();
$selct = new Enrollment();
$courses = $selct->get_all_courses_activer($conction);
session_start();
        
$data = $_SESSION['user'] ;
$id_cours = '';
$student_id = $data['id'];
$user = new User();


$message1 = "Échec, tu es déjà inscrit.";
$message2 = "L'etudiant est inscrit avec succés";
$message = '';
if (isset($_GET['cours_id']) && isset($_GET['teacher_id'])) {
    $cours_id = $_GET['cours_id'];
    $teacher_id = $_GET['teacher_id'];
    

    $message = $user->Enrollment($conction,$cours_id,$student_id,$teacher_id);
    
}

$searchTerm = '';
$courses = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $courses = $selct->search_courses($conction, $searchTerm);
} else {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max($page,1); 
    $items_per_page = 6;
    $offset = ($page - 1) * $items_per_page;
    $courses = $selct->get_all_courses_activer_paginasion($conction, $items_per_page, $offset);
    $total_courses = $selct->toutal_cours_active_($conction,$student_id);
    $total_pages = ceil($total_courses / $items_per_page);
 
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Espace Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-10">
    <div class="px-4 py-3 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <button id="toggleSidebar" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <span class="text-xl font-bold text-blue-600">EduPortal</span>
        </div>
        
        <div class="flex items-center gap-6">
        <div class="hidden md:flex items-center gap-2 bg-gray-100 px-3 py-2 rounded-lg">
            <form method="POST" action="./student.php" class="flex items-center w-full">
                <i class="fas fa-search text-gray-500"></i>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Rechercher un cours..." 
                    value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>" 
                    class="bg-transparent outline-none w-48"
                >
                <button type="submit" class="hidden"></button>
            </form>
        </div>

            
            <a href="./mes_cours.php" class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
                <i class="fas fa-book text-xl"></i>
                <span>Mes cours</span>
            </a>
            
            <button class="relative">
                <i class="fas fa-bell text-gray-600 text-xl"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
                    2
                </span>
            </button>
            
            <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full">
            
            <a href="../../auth/logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-sign-out-alt"></i>
                <span>Déconnexion</span>
            </a>
        </div>
    </div>
</nav>

    
    <!-- Dashboard Header -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-8">
            <h1 class="text-3xl font-bold text-gray-800 mt-12">Bonjour, <?php echo $data['username'] ?></h1>
            <p class="text-gray-600 mt-2">Continuez votre apprentissage là où vous vous êtes arrêté</p>
        </div>
    </div>


    <!-- Recommended Courses -->
    <div class="container mx-auto px-6 py-8">
    <?php
    if ($message === 1) {
        echo "<div id='message' class='flex justify-center bg-green-100 text-white p-4 rounded'>{$message2}</div>";
    } else {
        echo "<div id='message' class='flex justify-center bg-red-100 text-white p-4 rounded'>{$message1}</div>";
    }
    ?>
</div>
    <script>
        setTimeout(function () {
            const messageDiv = document.getElementById('message');
            if (messageDiv) {
                messageDiv.style.display = 'none';
            }
        }, 2000);
    </script>

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Recommandé pour vous</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Course Card 1 -->
             <?php foreach ($courses as $cours) { ?>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="/api/placeholder/400/200" alt="Vue.js" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2">
                        <?php echo $cours['title'] ?>
                    </h3>
                    <p class="text-gray-600 mb-4"><?php echo $cours['description'] ?></p>
                    <div class="flex items-center justify-between">
                        <span class="text-blue-600 font-semibold">29.99€</span>
                        <div class="flex items-center">
                            <a href="../courses/cours.php?cours_id=<?php echo $cours['id'] ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                <i class="fas fa-info-circle"></i> 
                            </a>

                            <a href="./student.php?cours_id=<?php echo $cours['id']; ?>&teacher_id=<?php echo $cours['teacher_id']; ?>" 
                                id="enrollButton" 
                                class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition ml-2">
                                    <i class="fas fa-user-plus"></i> Enrollment
                                </a>

                        </div>
                    </div>
                </div>
            </div>

            <?php  } ?>
        </div>
    </div>
    <div class="mt-8 flex justify-center">
            <nav class="flex space-x-2">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Précédent</a>
                <?php endif; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Suivant</a>
                <?php endif; ?>
            </nav>
</div>
    <!-- Achievement Section -->
    <div class="bg-gray-100 py-8">
        <div class="container mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Vos réalisations</h2>
            <div class="grid md:grid-cols-4 gap-4">
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">4</div>
                    <div class="text-gray-600">Cours complétés</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">12</div>
                    <div class="text-gray-600">Heures d'apprentissage</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">8</div>
                    <div class="text-gray-600">Certificats obtenus</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">95%</div>
                    <div class="text-gray-600">Taux de réussite</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2025 Youdemy. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>