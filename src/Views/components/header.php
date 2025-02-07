<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy</title>
    <link rel="icon" type="image/svg+xml" href="assets/images/icons/favicon.svg">
    <link rel="alternate icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="stylesheet" href="assets/css/output.css">
    <link rel="stylesheet" href="assets/css/input.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-900">
    <!-- Navigation (same as homepage) -->
    <nav class="bg-gray-800/50 backdrop-blur-lg border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-teal-300">Youdemy</a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button type="button" onclick="toggleMenu()" class="text-gray-300 hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                <!-- Desktop menu -->
                <div class="hidden md:flex items-center space-x-8">
                    
                    <a href="/catalogue" class="text-gray-300 hover:text-blue-400 font-medium">Catalogue</a>
                    <?php if(!isset($isLogged) || !$isLogged) echo '<a href="/authentification" class="px-6 py-3 rounded-full text-white bg-gradient-to-r from-blue-500 to-teal-400 hover:from-blue-600 hover:to-teal-500">Commencer</a>'; ?>
                    <?php if(isset($isLogged) && $isLogged && $user->role === "student"){
                            echo '<a href="/myCourses" class="text-gray-300 hover:text-blue-400 font-medium">My Courses</a>';
                            echo '<a href="/logout" class="px-6 py-3 rounded-full text-white bg-gradient-to-r from-blue-500 to-teal-400 hover:from-blue-600 hover:to-teal-500">logout</a>'; 
                            }
                            else if(isset($isLogged) && $isLogged && $user->role === "teacher"){
                                 echo '<a href="/logout" class="px-6 py-3 rounded-full text-white bg-gradient-to-r from-blue-500 to-teal-400 hover:from-blue-600 hover:to-teal-500">logout</a>';
                            }
                        ?>

                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-gray-800/50 backdrop-blur-lg border-b border-gray-700">
                <a href="/catalogue" class="block px-3 py-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700">Catalogue</a>
                <div class="px-3 pt-4">
                    <a href="/authentification" class="block px-6 py-3 text-center rounded-full text-white bg-gradient-to-r from-blue-500 to-teal-400 hover:from-blue-600 hover:to-teal-500">Commencer</a>
                </div>
            </div>
        </div>
    </nav>