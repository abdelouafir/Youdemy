<div class="px-4 py-3 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <button id="toggleSidebar" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <span class="text-xl font-bold text-blue-600">Youdemy</span>
        </div>
        
        <div class="flex items-center gap-6">
            <div class="hidden md:flex items-center gap-2 bg-gray-100 px-3 py-2 rounded-lg">
                <i class="fas fa-search text-gray-500"></i>
                <input type="text" placeholder="Rechercher un cours..." class="bg-transparent outline-none w-48">
            </div>
            
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