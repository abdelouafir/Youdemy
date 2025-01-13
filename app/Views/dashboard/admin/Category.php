
<?php 
require_once dirname(__FILE__, 5) . '/vendor/autoload.php';
use app\Config\Database;
use app\Controllers\category;
$conn = new Database();
$conction = $conn->getConnection();
$ins = new category();
$tags = $ins->get_categories($conction);
$categories = $ins->get_categories($conction);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category_name'])) {
    $tags = $_POST['category_name']; 
    $re = category::create_category($conction, $tags);
    header("location: ./Category.php");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category_id'])) {
    $id = $_POST['category_id']; 
    $delete = category::delete_category($conction,$id);
    header("location: ./Category.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-center mb-8">Manage Categories</h1>
        <!-- Add Category Form -->
        <div class="bg-white shadow-md rounded-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Add New Category</h2>
            <form action="./Category.php" method="POST" class="flex items-center gap-4">
                <input type="text" name="category_name" placeholder="Enter category name" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" name="add_category" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Add
                </button>
            </form>
        </div>

        <!-- Categories Table -->
        <div class="bg-white shadow-md rounded-md p-6">
            <h2 class="text-xl font-semibold mb-4">Category List</h2>
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category) : ?>
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2"><?= $category['id']?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= $category['name'] ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-center flex justify-center gap-2">
                                <!-- Edit Button -->
                            <form action="/ruturn/update_category.php" method="POST" class="inline-block">
                                <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                                <input type="text" name="category_name" 
                                    value="<?= $category['name'] ?>" 
                                    class="px-2 py-1 border border-gray-300 rounded-md">
                                <button type="submit" name="edit_category" 
                                        class="px-4 py-2 rounded-md hover:bg-yellow-600">
                                    <i class="fas fa-edit text-yellow-500"></i>
                                </button>
                            </form>

                            <!-- Delete Form -->
                            <form action="./Category.php" method="POST" class="inline-block">
                                <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                                <button type="submit" name="delete_category" 
                                        class="px-4 py-2 rounded-md hover:bg-red-600">
                                    <i class="fas fa-trash text-red-500"></i>
                                </button>
                            </form>


                            </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
