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
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white border-b fixed w-full z-10">
        <div class="px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <button id="toggleSidebar" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 text-transparent bg-clip-text">Youdemy</span>
            </div>
            
            <div class="flex items-center gap-8">
                <div class="hidden md:flex items-center gap-3 bg-gray-100 px-4 py-2.5 rounded-full">
                    <i class="fas fa-search text-gray-400"></i>
                    <input type="text" placeholder="Rechercher..." class="bg-transparent outline-none w-56 text-sm">
                </div>
                
                <button class="relative hover:bg-gray-100 p-2 rounded-full transition-colors">
                    <i class="fas fa-bell text-gray-500 text-xl"></i>
                    <span class="absolute -top-0.5 -right-0.5 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        3
                    </span>
                </button>
                
                <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full ring-2 ring-gray-200">
                
                <a href="../../auth/logout.php" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-5 py-2.5 rounded-full flex items-center gap-2 transition-all shadow-lg shadow-red-500/30">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 mt-16 h-full bg-white border-r w-64 transition-all duration-300">
        <div class="py-6">
            <nav class="space-y-1">
                <a href="./home.php" class="flex items-center gap-4 px-6 py-3.5 text-gray-600 hover:bg-blue-50/80 hover:text-blue-600 transition-colors rounded-r-full">
                    <i class="fas fa-home text-lg"></i>
                    <span class="sidebar-text font-medium">Home</span>
                </a>
                <a href="./Enseignant.php" class="flex items-center gap-4 px-6 py-3.5 text-gray-600 hover:bg-blue-50/80 hover:text-blue-600 transition-colors rounded-r-full">
                    <i class="fas fa-book-open text-lg"></i>
                    <span class="sidebar-text font-medium">Mes Cours</span>
                </a>
                <a href="#" class="flex items-center gap-4 px-6 py-3.5 text-gray-600 hover:bg-blue-50/80 hover:text-blue-600 transition-colors rounded-r-full">
                    <i class="fas fa-user-graduate text-lg"></i>
                    <span class="sidebar-text font-medium">Élèves</span>
                </a>
                <a href="#" class="flex items-center gap-4 px-6 py-3.5 text-gray-600 hover:bg-blue-50/80 hover:text-blue-600 transition-colors rounded-r-full">
                    <i class="fas fa-cog text-lg"></i>
                    <span class="sidebar-text font-medium">Paramètres</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main id="mainContent" class="pt-24 ml-64 transition-all duration-300">
        <div class="p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    Bienvenue, Professeur <?php echo $data['username'] ?>
                </h1>
                <a href="../../courses/create.php" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-full flex items-center gap-3 transition-all shadow-lg shadow-blue-500/30">
                    <i class="fas fa-plus"></i>
                    <span>Ajouter un cours</span>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-blue-50 rounded-xl">
                            <i class="fas fa-book text-blue-600 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700">Total de cours</h3>
                    </div>
                    <p class="text-3xl font-bold text-blue-600"><?php echo $emrollement->toutal_cours($conction,$data['id']) ?></p>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-green-50 rounded-xl">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700">Cours actifs</h3>
                    </div>
                    <p class="text-3xl font-bold text-green-600"><?php echo $emrollement->toutal_cours_active($conction,$data['id'])?></p>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-yellow-50 rounded-xl">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700">En attente</h3>
                    </div>
                    <p class="text-3xl font-bold text-yellow-600"><?php echo $emrollement->toutal_cours_attonte($conction,$data['id'])?></p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-red-50 rounded-xl">
                            <i class="fas fa-ban text-red-600 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700">Cours bloqués</h3>
                    </div>
                    <p class="text-3xl font-bold text-red-600"><?php echo $emrollement->toutal_cours_block($conction,$data['id'])?></p>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-purple-50 rounded-xl">
                            <i class="fas fa-users text-purple-600 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-700">Total élèves</h3>
                    </div>
                    <p class="text-3xl font-bold text-purple-600"><?php echo $emrollement->total_eleve($conction,$data['id']) ?></p>
                </div>
        </div>
    </main>

    <script src="../../../public/js/script.js"></script>
</body>
</html>