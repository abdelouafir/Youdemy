<nav aria-label="alternative nav">
    <div class="bg-white shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center" style="width:16rem; height:100%">
        <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
            <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left" style="padding-top:5rem;">
            <li class="mr-3 flex-1">
                <a href="/app/views/dashboard/admin/admin.php" class="block py-1 md:py-3 pl-1 align-middle text-gray-700 no-underline hover:text-blue-600 border-b-2 border-white hover:border-blue-500" style="width:20rem;">
                    <i class="fas fa-home pr-0 md:pr-3 text-gray-600 hover:text-blue-600"></i>
                    <span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 block md:inline-block">
                        Home
                    </span>
                </a>
            </li>

                <!-- Gestion des utilisateurs -->
                <li class="mr-3 flex-1">
                    <a href="/app/views/dashboard/admin/GestionUtilsateur.php" class="block py-1 md:py-3 pl-1 align-middle text-gray-700 no-underline hover:text-pink-600 border-b-2 border-white hover:border-pink-500" style="width:20rem">
                        <i class="fas fa-user-cog pr-0 md:pr-3 text-gray-600 hover:text-pink-600"></i>
                        <span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 block md:inline-block">
                            Gestion des utilisateurs
                        </span>
                    </a>
                </li>

                <!-- Gestion des contenus -->
                <li class="mr-3 flex-1">
                    <a href="/app/views/dashboard/admin/GestionContenus.php" class="block py-1 md:py-3 pl-1 align-middle text-gray-700 no-underline hover:text-purple-600 border-b-2 border-white hover:border-purple-500" style="width:20rem">
                        <i class="fas fa-file-alt pr-0 md:pr-3 text-gray-600 hover:text-purple-600"></i>
                        <span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 block md:inline-block">
                            Gestion des contenus
                        </span>
                    </a>
                </li>

                <!-- Tags -->
                <li class="mr-3 flex-1">
                    <a href="/app/views/dashboard/admin/tags.php" class="block py-1 md:py-3 pl-1 align-middle text-gray-700 no-underline hover:text-blue-600 border-b-2 border-white hover:border-blue-500">
                        <i class="fas fa-tags pr-0 md:pr-3 text-gray-600 hover:text-blue-600"></i>
                        <span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 block md:inline-block">
                            Tags
                        </span>
                    </a>
                </li>

                <!-- Catégories -->
                <li class="mr-3 flex-1">
                    <a href="/app/views/dashboard/admin/Category.php" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-gray-700 no-underline hover:text-red-600 border-b-2 border-white hover:border-red-500">
                        <i class="fas fa-folder-open pr-0 md:pr-3 text-gray-600 hover:text-red-600"></i>
                        <span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 block md:inline-block">
                            Catégorie
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>