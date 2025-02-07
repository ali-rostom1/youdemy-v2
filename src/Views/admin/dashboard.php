<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="icon" type="image/svg+xml" href="../assets/images/icons/favicon.svg">
    <link rel="alternate icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-dark">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-dark-lighter border-r border-gray-700">
            <div class="p-6">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-500 to-teal-400 bg-clip-text text-transparent">Youdemy Admin</h1>
            </div>
            <nav class="space-y-1">
                <a href="#" class="flex items-center px-6 py-3 text-gray-100 bg-gray-700">
                    <span class="inline-block mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </span>
                    Dashboard
                </a>
                <a href="/admin/users" class="flex items-center px-6 py-3 text-gray-400 hover:bg-gray-700 hover:text-white transition-colors">
                    <span class="inline-block mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </span>
                    Users
                </a>
                <a href="/admin/courses" class="flex items-center px-6 py-3 text-gray-400 hover:bg-gray-700 hover:text-white transition-colors">
                    <span class="inline-block mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </span>
                    Courses
                </a>
                <a href="/admin/category" class="flex items-center px-6 py-3 text-gray-400 hover:bg-gray-700 hover:text-white transition-colors">
                    <span class="inline-block mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                    </span>
                    Categories
                </a>
                <a href="/admin/tags" class="flex items-center px-6 py-3 text-gray-400 hover:bg-gray-700 hover:text-white transition-colors">
                    <span class="inline-block mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </span>
                    Tags
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-6 py-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-semibold text-white">Dashboard Overview</h2>
                    <div>
                        <a href="/logout" class="px-4 py-2 text-gray-100 bg-red-600 rounded-lg hover:bg-red-700 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Users -->
                    <div class="bg-dark-lighter rounded-lg p-6 border border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Total Students</p>
                                <p class="text-2xl font-bold text-white mt-1"><?php echo $totalStudents; ?></p>
                            </div>
                            <div class="bg-blue-500/20 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>

                    </div>

                    <!-- teachers -->
                    <div class="bg-dark-lighter rounded-lg p-6 border border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Total Teachers</p>
                                <p class="text-2xl font-bold text-white mt-1"><?php echo $totalTeachers ?></p>
                            </div>
                            <div class="bg-purple-500/20 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                    </div>

                    <!-- Active Courses -->
                    <div class="bg-dark-lighter rounded-lg p-6 border border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Active Courses</p>
                                <p class="text-2xl font-bold text-white mt-1"><?php echo $totalCourses ?></p>
                            </div>
                            <div class="bg-purple-500/20 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        </div>
                        
                    </div>

                    <!-- Enrollments -->
                    <div class="bg-dark-lighter rounded-lg p-6 border border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-400">Total Enrollments</p>
                                <p class="text-2xl font-bold text-white mt-1"><?php echo $totalEnrollments ?></p>
                            </div>
                            <div class="bg-yellow-500/20 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Revenue Chart -->
                    <div class="bg-dark-lighter rounded-lg p-6 border border-gray-700">
                        <h3 class="text-lg font-semibold text-white mb-4">Revenue Overview</h3>
                        <canvas id="coursesPerTeacherCtx" class="w-full h-64"></canvas>
                    </div>

                    <!-- Enrollment Chart -->
                    <div class="bg-dark-lighter rounded-lg p-6 border border-gray-700">
                        <h3 class="text-lg font-semibold text-white mb-4">Enrollment Trends</h3>
                        <canvas id="topCoursesByEnrollments" class="w-full h-64"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../assets/js/admin/dashboard.js" type="module"></script>
</body>
</html>