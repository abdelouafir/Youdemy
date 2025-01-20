
<?php 

require_once dirname(__FILE__, 5).'/vendor/autoload.php';
use app\Config\Database;
use app\Models\admin;

$conn = new Database();
$toutal_user = new admin();
$conction = $conn->getConnection();

session_start();
        
$data = $_SESSION['user'] ;
if($data){
    if($data['role'] != 'admin'){
        header('location: ../../auth/404.php');
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwind Admin Starter Template : Tailwind Toolbox</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/> <!--Replace with your tailwind.css once created-->
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> <!--Totally optional :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>

</head>
<body class="font-sans leading-normal tracking-normal mt-12">

<!--  heder  -->
 <?php include "../../layout/header.php" ?>

<main>

    <div class="flex flex-col md:flex-row">
        <!-- nav -->
         <?php include "../../layout/nav.php" ?>
        <section style="width:200rem;">
            <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

                <div class="bg-gray-800 pt-3">
                    <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                        <h1 class="font-bold pl-2">Analytics</h1>
                    </div>
                </div>

                <div class="flex flex-wrap">
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-green-600">
                                        <i class="fa fa-user-graduate fa-2x fa-inverse"></i>
                                    </div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Total Étudiant</h2>
                                    <p class="font-bold text-3xl"><?php echo $toutal_user->toutal_student($conction);?> <span class="text-green-500"><i class="fas fa-caret-up text-xl"></i></span></p>
                                </div>
                            </div>
                        </div>

                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-pink-600">
                                        <i class="fas fa-users fa-2x fa-inverse"></i>
                                    </div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">Total Users</h2>
                                    <p class="font-bold text-3xl"><?php echo $toutal_user->toutal_users($conction);?><span class="text-pink-500"><i class="fas fa-exchange-alt text-xl"></i></span></p>
                                </div>
                            </div>
                        </div>

                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">New Users</h2>
                                    <p class="font-bold text-3xl">2 <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span></p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-blue-600">
                                        <i class="fas fa-chalkboard-teacher fa-2x fa-inverse"></i>
                                    </div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">TOTAL Enseignant</h2>
                                    <p class="font-bold text-3xl"><?php echo $toutal_user->toutal_enseignant($conction);?></p>
                                </div>
                            </div>
                        </div>

                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-indigo-200 to-indigo-100 border-b-4 border-indigo-500 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-4">
                            <div class="rounded-full p-5 bg-indigo-600">
                                <i class="fas fa-chalkboard fa-2x fa-inverse"></i>
                            </div>
                        </div>
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">COURS</h2>
                            <p class="font-bold text-3xl"><?php echo $toutal_user->toutal_cours($conction);?></p>
                        </div>
                    </div>
                </div>

                        <!--/Metric Card-->
                    </div>
                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Metric Card-->
                        <div class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
                            <div class="flex flex-row items-center">
                                <div class="flex-shrink pr-4">
                                    <div class="rounded-full p-5 bg-red-600"><i class="fas fa-inbox fa-2x fa-inverse"></i></div>
                                </div>
                                <div class="flex-1 text-right md:text-center">
                                    <h2 class="font-bold uppercase text-gray-600">ADMINS</h2>
                                    <p class="font-bold text-3xl"><?php echo $toutal_user->toutal_admin($conction);?> <span class="text-red-500"><i class="fas fa-caret-up"></i></span></p>
                                </div>
                            </div>
                        </div>
                        <!--/Metric Card-->
                    </div>
                </div>


                <div class="flex flex-row flex-wrap flex-grow mt-2">

                <div class="w-full md:w-1/2 xl:w-1/3 p-6">

                </div>

                <div class="w-full md:w-1/2 xl:w-1/3 p-6">

                </div>

                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                </div>

                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Graph Card-->
                    <div class="bg-white border-transparent rounded-lg shadow-xl">
                        <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                            <h5 class="font-bold uppercase text-gray-600">Graph</h5>
                        </div>
                        <div class="p-5"><canvas id="chartjs-4" class="chartjs" width="undefined" height="undefined"></canvas>
                            <script>
                                new Chart(document.getElementById("chartjs-4"), {
                                    "type": "doughnut",
                                    "data": {
                                        "labels": ["P1", "P2", "P3"],
                                        "datasets": [{
                                            "label": "Issues",
                                            "data": [300, 50, 100],
                                            "backgroundColor": ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)"]
                                        }]
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    <!--/Graph Card-->
                </div>

                    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                        <!--Table Card-->
                        <div class="bg-white border-transparent rounded-lg shadow-xl">
                            <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                <h2 class="font-bold uppercase text-gray-600">Graph</h2>
                            </div>
                            <div class="p-5">
                                <table class="w-full p-5 text-gray-700">
                                    <thead>
                                    <tr>
                                        <th class="text-left text-blue-900">Name</th>
                                        <th class="text-left text-blue-900">Side</th>
                                        <th class="text-left text-blue-900">Role</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>Obi Wan Kenobi</td>
                                        <td>Light</td>
                                        <td>Jedi</td>
                                    </tr>
                                    <tr>
                                        <td>Greedo</td>
                                        <td>South</td>
                                        <td>Scumbag</td>
                                    </tr>
                                    <tr>
                                        <td>Darth Vader</td>
                                        <td>Dark</td>
                                        <td>Sith</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <p class="py-2"><a href="#">See More issues...</a></p>

                            </div>
                        </div>
                        <!--/table Card-->
                    </div>

                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Advert Card-->
                    <div class="bg-white border-transparent rounded-lg shadow-xl">
                        <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                            <h2 class="font-bold uppercase text-gray-600">Advert</h2>
                        </div>
                        <div class="p-5 text-center">


                            <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CK7D52JJ&placement=wwwtailwindtoolboxcom" id="_carbonads_js"></script>


                        </div>
                    </div>
                    <!--/Advert Card-->
                </div>


                </div>
            </div>
        </section>
    </div>
</main>




<script>
    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
        var input, filter, ul, li, a, i;
        input = document.getElementById(myDropMenuSearch);
        filter = input.value.toUpperCase();
        div = document.getElementById(myDropMenu);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
            var dropdowns = document.getElementsByClassName("dropdownlist");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('invisible')) {
                    openDropdown.classList.add('invisible');
                }
            }
        }
    }
</script>


</body>

</html>
