<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Espace Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="text-2xl font-bold">Youdemy</div>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="hover:text-blue-400 transition">Tableau de bord</a>
                <a href="#" class="hover:text-blue-400 transition">Mes cours</a>
                <a href="#" class="hover:text-blue-400 transition">Favoris</a>
                <div class="relative">
                    <img src="/api/placeholder/40/40" alt="Profile" class="w-8 h-8 rounded-full cursor-pointer">
                </div>
            </div>
        </div>
    </nav>

    <!-- Dashboard Header -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-8">
            <h1 class="text-3xl font-bold text-gray-800">Bonjour, Thomas</h1>
            <p class="text-gray-600 mt-2">Continuez votre apprentissage là où vous vous êtes arrêté</p>
        </div>
    </div>

    <!-- Progress Section -->
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Cours en cours</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Course Progress Card 1 -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold">JavaScript Avancé</h3>
                    <span class="text-blue-600 font-medium">75% complété</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                </div>
                <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Continuer
                </button>
            </div>
            
            <!-- Course Progress Card 2 -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold">React Fondamentaux</h3>
                    <span class="text-blue-600 font-medium">45% complété</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                </div>
                <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Continuer
                </button>
            </div>
        </div>
    </div>

    <!-- Recommended Courses -->
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Recommandé pour vous</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Course Card 1 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="/api/placeholder/400/200" alt="Vue.js" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2">Vue.js pour débutants</h3>
                    <p class="text-gray-600 mb-4">Apprenez Vue.js de zéro</p>
                    <div class="flex items-center justify-between">
                        <span class="text-blue-600 font-semibold">29.99€</span>
                        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                            Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="/api/placeholder/400/200" alt="Python" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2">Python Data Science</h3>
                    <p class="text-gray-600 mb-4">Analyse de données avec Python</p>
                    <div class="flex items-center justify-between">
                        <span class="text-blue-600 font-semibold">49.99€</span>
                        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                            Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="/api/placeholder/400/200" alt="UX Design" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2">UX Design Masterclass</h3>
                    <p class="text-gray-600 mb-4">Design d'interfaces utilisateur</p>
                    <div class="flex items-center justify-between">
                        <span class="text-blue-600 font-semibold">39.99€</span>
                        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                            Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>
        </div>
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