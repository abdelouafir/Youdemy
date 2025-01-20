<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traitement en cours</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full mx-auto">
        <div class="text-center">
            <!-- Titre -->
            <h1 class="text-2xl font-bold text-gray-800 mb-4">
                Traitement en cours
            </h1>

            <!-- Spinner -->
            <div class="flex justify-center mb-6">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-gray-200 border-t-blue-500"></div>
            </div>

            <!-- Messages -->
            <div class="space-y-2">
                <p class="text-gray-600">
                    Votre compte est en cours de traitement
                </p>
                <p class="text-gray-500">
                    Veuillez patienter...
                </p>
            </div>

            <!-- Barre de progression -->
            <div class="mt-6 h-2 bg-gray-200 rounded-full overflow-hidden">
                <div class="h-full bg-blue-500 rounded-full animate-pulse"></div>
            </div>
        </div>
    </div>

    <script>
        // Animation des points de chargement
        let dots = '';
        setInterval(() => {
            const waitText = document.querySelector('.text-gray-500');
            dots = dots.length >= 3 ? '' : dots + '.';
            waitText.textContent = 'Veuillez patienter' + dots;
        }, 500);
    </script>
</body>
</html>