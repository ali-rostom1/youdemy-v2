<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="icon" type="image/svg+xml" href="../assets/images/icons/favicon.svg">
    <link rel="alternate icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <style>
        /* Choices.js custom styles */
        .choices { margin-bottom: 0; }
        .choices__inner {
            min-height: 42px !important;
            background-color: white !important;
            border-radius: 0.375rem !important;
            border-color: rgb(209 213 219) !important;
        }
        .choices__input { background-color: white !important; }
        .choices__list--multiple .choices__item {
            background-color: rgb(59 130 246) !important;
            border: none !important;
        }
        .choices__list--dropdown { background-color: white !important; }
    </style>
</head>
<body class="bg-blue-50">
    <div class="flex flex-col md:flex-row min-h-screen bg-blue-50">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-white shadow-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-blue-800">Teacher Panel</h1>
            </div>
            <nav class="space-y-1">
                <a href="/teacher/dashboard" class="flex items-center px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors">
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
                <a href="#" class="flex items-center px-6 py-3 text-blue-600 bg-blue-50">
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
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800">Create New Course</h2>
                </div>

                <!-- Course Creation Form -->
                <div class="bg-white rounded-lg p-8 shadow-sm">
                    <form id="createCourseForm" class="space-y-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Course Title</label>
                            <input type="text" name="title" required
                                   class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm 
                                          focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                                          transition duration-150 ease-in-out">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" required
                                    class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm 
                                           focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                                           transition duration-150 ease-in-out bg-white">
                                <?php foreach($categories as $category): ?>
                                    <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Tags</label>
                            <select id="courseTags" name="tags[]" multiple class="mt-1 block w-full">
                                <?php foreach($tags as $tag): ?>
                                    <option value="<?php echo $tag->id ?>"><?php echo $tag->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Course Description</label>
                            <textarea name="description" required
                                    class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm 
                                           focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                                           transition duration-150 ease-in-out min-h-[100px]"
                                    placeholder="Enter course description..."></textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Course Type</label>
                            <select name="type" id="courseType" required
                                    class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm 
                                           focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                                           transition duration-150 ease-in-out bg-white">
                                <option value="video">Video Course</option>
                                <option value="document">Document Course</option>
                            </select>
                        </div>

                        <!-- Dynamic Content Input -->
                        <div id="contentInput" class="space-y-2">
                            <!-- Will be populated based on course type -->
                        </div>

                        <div class="flex justify-end space-x-4 pt-4 mt-6 border-t border-gray-200">
                            <a href="/teacher/courses" 
                               class="px-6 py-2.5 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 
                                      transition duration-150 ease-in-out focus:outline-none focus:ring-2 
                                      focus:ring-gray-400 focus:ring-opacity-50">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 
                                           transition duration-150 ease-in-out focus:outline-none focus:ring-2 
                                           focus:ring-blue-500 focus:ring-opacity-50">
                                Create Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        let editor = null;
        let tagSelect = null;

        // Initialize Choices.js
        document.addEventListener('DOMContentLoaded', function() {
            tagSelect = new Choices('#courseTags', {
                removeItemButton: true,
                maxItemCount: 5,
                searchEnabled: true,
                searchPlaceholderValue: 'Search tags...',
                placeholder: true,
                placeholderValue: 'Select tags',
                noChoicesText: 'No more tags available'
            });

            // Initial content input setup
            updateContentInput(document.getElementById('courseType').value);
        });

        // Handle course type changes
        document.getElementById('courseType').addEventListener('change', function(e) {
            updateContentInput(e.target.value);
        });

        function updateContentInput(type) {
            const contentInput = document.getElementById('contentInput');
            if (editor) {
                editor.destroy();
                editor = null;
            }

            if (type === 'video') {
                contentInput.innerHTML = `
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Video URL</label>
                        <input type="url" name="content" required
                               class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm 
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                                      transition duration-150 ease-in-out">
                    </div>
                `;
            } else {
                contentInput.innerHTML = `
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Document Content</label>
                        <textarea id="documentContent" name="content" 
                                  class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm 
                                         focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                                         transition duration-150 ease-in-out min-h-[200px]"></textarea>
                    </div>
                `;
                ClassicEditor
                    .create(document.querySelector('#documentContent'))
                    .then(newEditor => {
                        editor = newEditor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }

        document.getElementById('createCourseForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            
            if (editor) {
                formData.set('content', editor.getData());
                if(editor.getData().trim() === ''){
                    alert('Please enter course content');
                    return;
                }
            }


            try {
                const response = await fetch('/course/create', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                
                if (data.success) {
                    window.location.href = '/teacher/courses';
                } else {
                    alert('Error creating course');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error creating course');
            }
        });
    </script>
</body>
</html>