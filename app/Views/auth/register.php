<?php 

 require_once dirname(__FILE__, 4) . '/vendor/autoload.php';
use app\Config\Database;
use app\Models\Enrollment;


$conn = new Database();
$conction = $conn->getConnection();

$message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['confirmPassword'] ?? '';

 
    $errors = [];

   
    if (empty($role)) {
        $errors['role'] = "Veuillez sélectionner un rôle.";
    }

    if (empty($username) || strlen($username) < 3) {
        $errors['username'] = "Le nom d'utilisateur est requis et doit contenir au moins 3 caractères.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Veuillez entrer une adresse e-mail valide.";
    }

    if (empty($password) || strlen($password) <= 4) {
        $errors['password'] = "Le mot de passe est requis et doit contenir au moins 6 caractères.";
    }

    if (empty($errors)) {
        $Enrollment = new Enrollment($username, $email, $password, $role);
        $message = $Enrollment->register($conction, $password, $username, $email, $role);
        echo "<p style='color: green;'>$message</p>";
    }
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
            <?php if ($message): ?>
                    <div class="mt-4 text-center text-green-600"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
            
            <form method="POST" action="./register.php"  class="mt-8 space-y-6">
                <!-- Role Selection -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative">
                        <input type="radio" name="role" id="student" class="peer hidden" checked value="student">
                        <label for="student" class="block cursor-pointer select-none rounded-lg p-4 text-center border-2 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50">
                            <div class="text-blue-600 font-semibold">Étudiant</div>
                            <div class="text-gray-500 text-sm mt-2">Je veux apprendre</div>
                        </label>
                    </div>
                    
                    <div class="relative">
                        <input type="radio" name="role" id="instructor" class="peer hidden" value="Enseignant">
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
                            <input type="text" id="username" name="username"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                                <?php if (isset($errors['username'])): ?>
                                <p class="text-red-500 text-sm"><?= $errors['username'] ?></p>
                              <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input type="email" id="email" name="email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">

                            <?php if (isset($errors['email'])): ?>
                                <p class="text-red-500 text-sm"><?= $errors['email'] ?></p>
                              <?php endif; ?>
                        
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Mot de passe
                        </label>
                        <input type="password" id="password" name="password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">

                        <?php if (isset($errors['password'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['password'] ?></p>
                            <?php endif; ?>
                    </div>

                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700">
                            Confirmer le mot de passe
                        </label>
                        <input type="password" id="confirmPassword" name="confirmPassword"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-center">
                    <input type="checkbox" id="terms" name="terms"
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
                    <a href="./logout.php" class="font-medium text-blue-600 hover:text-blue-500">
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