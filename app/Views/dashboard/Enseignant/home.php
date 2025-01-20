<?php 
require_once "../../../../vendor/autoload.php";
use app\Config\Database;
use app\Models\Enrollment;

$conn = new Database();
$emrollement = new Enrollment();

$conction = $conn->getConnection();
session_start();


if (isset($_SESSION['user'])) {
    $data = $_SESSION['user'];

    if ($data['role'] == 'student') {
        header('Location: ../../auth/404.php');
        exit;
    }
} else {
    header('Location: ../../auth/login.php');
    exit;
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Enseignant</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
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
                    <i class="fas fa-search text-gray-500"></i>
                    <input type="text" placeholder="Rechercher..." class="bg-transparent outline-none w-48">
                </div>
                
                <button class="relative">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
                        3
                    </span>
                </button>
                
                <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full">
                
                <!-- Nouveau bouton de déconnexion -->
                <a href="../../auth/logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 mt-16 h-full bg-white shadow-lg w-64 transition-all duration-300">
        <div class="py-4">
            <nav>
                <a href="./home.php" class="flex items-center gap-4 px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-home"></i>
                    <span class="sidebar-text">home</span>
                </a>
                <a href="./Enseignant.php" class="flex items-center gap-4 px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-book-open"></i>
                    <span class="sidebar-text">Mes Cours</span>
                </a>
                <a href="#" class="flex items-center gap-4 px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-user-graduate"></i> <!-- Icône d'élève -->
                    <span class="sidebar-text"> élèves</span>
                </a>

                <a href="#" class="flex items-center gap-4 px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-cog"></i>
                    <span class="sidebar-text">Paramètres</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main id="mainContent" class="pt-20 ml-64 transition-all duration-300">
        <div class="p-6">
            <!-- En-tête avec bouton d'ajout -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Bienvenue, Professeur <?php echo $data['username'] ?>
                </h1>
                <a href="../../courses/create.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Ajouter un nouveau cours</span>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Stats Cards -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                    Total de cours
                </h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo $emrollement->toutal_cours($conction,$data['id']) ?></p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                    Cours actifs
                </h3>
                <p class="text-3xl font-bold text-blue-600"><?php echo $emrollement->toutal_cours_active($conction,$data['id'])?></p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                    Cours en attente
                </h3>
                <p class="text-3xl font-bold text-blue-600">25</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                    Cours bloqués
                </h3>
                <p class="text-3xl font-bold text-blue-600">25</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                    Total des élèves
                </h3>
                <p class="text-3xl font-bold text-blue-600">25</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">
                    Devoirs à corriger
                </h3>
                <p class="text-3xl font-bold text-blue-600">25</p>
            </div>
        </div>

        </div>
    </main>

    <script src="../../../public/js/script.js">
     
    </script>
</body>
</html>