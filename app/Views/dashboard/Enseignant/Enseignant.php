<?php 
        require_once "../../../../vendor/autoload.php";
        use app\Config\Database;
        use app\Models\Enrollment;

    
       // use app\Models\Course;
        $conn = new Database();
        $emrollement = new Enrollment();
        
        $conction = $conn->getConnection();
       
        session_start();
        $data = $_SESSION['user'] ;
        if($data){
            if($data['role'] == 'student'){
                header('location: ../../auth/login.php');
            }
            $id = $data['id'];
            $my_cours = $emrollement->get_all_mycours($conction,$id);
        }
       
        $cours_id = $_GET['delet_id'] ?? null;
       
        // var_dump ($courses);
        if($cours_id){
            $emrollement->delete_cours($conction,$cours_id);
            header("location: ./Enseignant.php");
        }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-12 md:py-16">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        Bienvenue sur votre <br>
                        plateforme de cours
                    </h1>
                    <p class="text-lg md:text-xl text-blue-100 mb-8">
                        Gérez facilement vos cours, suivez vos élèves et organisez votre emploi du temps en un seul endroit.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-blue-50 transition-colors">
                            Commencer
                        </button>
                        <button class="px-6 py-3 bg-blue-700 text-white font-semibold rounded-lg hover:bg-blue-600 transition-colors">
                            En savoir plus
                        </button>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-900/20 rounded-lg backdrop-blur-sm"></div>
                        <img 
                            src="/api/placeholder/600/400" 
                            alt="Illustration cours" 
                            class="w-full h-auto rounded-lg shadow-xl"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <div class="max-w-7xl mx-auto my-8 px-4 md:px-6">
        <div class="bg-white rounded-xl shadow-sm p-4 md:p-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Mes Cours</h1>
                <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                    <div class="relative w-full md:w-80">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="text" 
                            id="searchInput"
                            placeholder="Rechercher un cours..." 
                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        >
                    </div>
                    <button class="flex items-center justify-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-filter text-gray-600"></i>
                        <span>Filtres</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Grid des cours -->
     
    <div id="coursesGrid" class="max-w-7xl mx-auto px-4 md:px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Course 1 -->
     <?php foreach($my_cours as $course) { ?>
    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
        <div class="relative h-48">
            <img src="/api/placeholder/400/320" alt="Mathématiques avancées" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                <h2 class="text-xl font-bold"><?php echo $course['title'] ?></h2>
                <p class="text-sm opacity-90">Enseignant <?php echo $course['username'] ?></p>
            </div>
        </div>
        <div class="p-4">
            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-md">Niveau : Terminal</span>
            <p class="mt-3 text-sm text-gray-600"><?php echo $course['content']?></p>
            <div class="mt-4 grid grid-cols-2 gap-3">
                <div class="flex items-center gap-2 text-gray-600"><i class="far fa-calendar text-sm"></i><span>Lundi</span></div>
                <div class="flex items-center gap-2 text-gray-600"><i class="fas fa-users text-sm"></i><span>25 étudiants</span></div>

            </div>
            <div class="mt-6 flex justify-between items-center">
                <a href="../courses/cours.php?cours_id=<?php echo $course['id']?>" class="text-blue-500 hover:text-blue-600 transition-colors" title="Lire plus"><i class="fas fa-book-open text-lg"></i></a>
                <div class="flex items-center gap-4">
                    <a href="/app/Controllers/updatecourse.php?id=<?php echo $course['id'] ?>" class="text-yellow-400 hover:text-yellow-500 transition-colors" title="Modifier"><i class="fas fa-edit text-lg"></i></a>
                    <a href="./Enseignant.php?delet_id=<?php echo $course['id']?>" class="text-red-500 hover:text-red-600 transition-colors" title="Supprimer"><i class="fas fa-trash-alt text-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php  } ?>



</div>



</body>
</html>
