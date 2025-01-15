<? require_once dirname(__FILE__, 5) . '/vendor/autoload.php';
use app\Config\Database;
$conn = new Database();
$conction = $conn->getConnection();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['confirmPassword'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Créer un compte</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white py-4">
        <div class="container mx-auto px-6">
            <div class="text-2xl font-bold">Youdemy</div>
        </div>
    </nav>

    <!-- Signup Form Section -->
    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Créer votre compte
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Rejoignez la communauté Youdemy
                </p>
            </div>
            
            <form class="mt-8 space-y-6">
                <!-- Role Selection -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative">
                        <input type="radio" name="role" id="student" class="peer hidden" checked>
                        <label for="student" class="block cursor-pointer select-none rounded-lg p-4 text-center border-2 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50">
                            <div class="text-blue-600 font-semibold">Étudiant</div>
                            <div class="text-gray-500 text-sm mt-2">Je veux apprendre</div>
                        </label>
                    </div>
                    
                    <div class="relative">
                        <input type="radio" name="role" id="instructor" class="peer hidden">
                        <label for="instructor" class="block cursor-pointer select-none rounded-lg p-4 text-center border-2 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50">
                            <div class="text-blue-600 font-semibold">Instructeur</div>
                            <div class="text-gray-500 text-sm mt-2">Je veux enseigner</div>
                        </label>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">
                                user name
                            </label>
                            <input type="text" id="username" name="username" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input type="email" id="email" name="email" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Mot de passe
                        </label>
                        <input type="password" id="password" name="password" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    </div>

                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700">
                            Confirmer le mot de passe
                        </label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-center">
                    <input type="checkbox" id="terms" name="terms" required
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-900">
                        J'accepte les <a href="#" class="text-blue-600 hover:text-blue-500">conditions d'utilisation</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Créer mon compte
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">
                    Déjà un compte ? 
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2025 Youdemy. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>