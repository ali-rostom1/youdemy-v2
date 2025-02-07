<?php 
    use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="icon" type="image/svg+xml" href="../assets/images/icons/favicon.svg">
    <link rel="alternate icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-blue-50">

    <div class="flex flex-col md:flex-row min-h-screen bg-blue-50">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-white shadow-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-blue-800">Teacher Panel</h1>
            </div>
            <nav class="space-y-1">
                <a href="#" class="flex items-center px-6 py-3 text-blue-600 bg-blue-50">
                    <span class="inline-block mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </span>
                    Dashboard
                </a>
                <a href="/teacher/courses" class="flex items-center px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <span class="inline-block mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </span>
                    My Courses
                </a>
                <a href="/teacher/create-course" class="flex items-center px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                    <span class="inline-block mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </span>
                    Create Course
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-6 py-8">
                <div class="flex flex-col md:flex-row items-center justify-between mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800">Teacher Overview</h2>
                    <a href="/logout" class="mt-4 md:mt-0 px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </a>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Courses -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">My Courses</p>
                                <p class="text-2xl font-bold text-blue-600 mt-1"><?php echo $totalCourses ?></p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Students -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Students</p>
                                <p class="text-2xl font-bold text-blue-600 mt-1"><?php echo $totalStudents ?></p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Enrollments -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Course Enrollments</p>
                                <p class="text-2xl font-bold text-blue-600 mt-1"><?php echo $totalEnrollments ?></p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Enrollment Trends</h3>
                        <canvas id="enrollmentChart" class="w-full h-64"></canvas>
                    </div>
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Top Courses</h3>
                        <canvas id="topCoursesChart" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Recent Enrollments -->
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Enrollments</h3>
                    <div class="space-y-4">
                        <?php foreach($recentEnrollments as $enrollment): ?>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-800"><?php echo $enrollment->course->title ?></p>
                                    <p class="text-xs text-gray-500"><?php echo $enrollment->user->username ?></p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600"><?php echo Carbon::instance($enrollment->enrollmentDate)->diffForHumans() ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        // Enrollment Trends Chart
        const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
        const enrollmentChart = new Chart(enrollmentCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_column($enrollmentsByMonth, 'month')); ?>,
                datasets: [{
                    label: 'Enrollments',
                    data: <?php echo json_encode(array_column($enrollmentsByMonth, 'TOTAL')); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    tension: 0.4, 
                    pointStyle: 'circle', 
                    pointRadius: 5, 
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)'
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Monthly Enrollments',
                        font: {
                            size: 18
                        }
                    },
                    tooltip: {
                        enabled: true,
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Enrollments'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                }
            }
        });

        // Top Courses Chart
        const topCoursesCtx = document.getElementById('topCoursesChart').getContext('2d');
        const topCoursesChart = new Chart(topCoursesCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($top3Courses, 'title')); ?>,
                datasets: [{
                    label: 'Enrollments',
                    data: <?php echo json_encode(array_column($top3Courses, 'TOTAL')); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Top Courses by Enrollments',
                        font: {
                            size: 18
                        }
                    },
                    tooltip: {
                        enabled: true,
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Enrollments'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Course'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>