<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="icon" type="image/svg+xml" href="assets/images/icons/favicon.svg">
    <link rel="alternate icon" type="image/png" href="/favicon.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
</head>
<body class="bg-dark">
    <div class="flex min-h-screen">
        <!-- Sidebar (Same as dashboard) -->
        <aside class="w-64 bg-dark-lighter border-r border-gray-700">
            <div class="p-6">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-500 to-teal-400 bg-clip-text text-transparent">Youdemy Admin</h1>
            </div>
            <nav class="space-y-1">
                <a href="/admin/dashboard" class="flex items-center px-6 py-3 text-gray-400 hover:bg-gray-700 hover:text-white transition-colors">
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
                <a href="#" class="flex items-center px-6 py-3 text-gray-100 bg-gray-700">
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
                    <h2 class="text-2xl font-semibold text-white">Course Management</h2>

                    <a href="/logout" class="px-4 py-2 text-gray-100 bg-red-600 rounded-lg hover:bg-red-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </a>
                </div>

                <!-- Filter Controls -->
                <div class="bg-dark-lighter rounded-lg p-6 border border-gray-700 mb-8">
                    <div class="flex items-center space-x-4">
                        <label class="text-gray-400">Filter by Category:</label>
                        <select id="categoryFilter" onchange="fetchData(1)" class="bg-dark border border-gray-600 text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Categories</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input id="search" oninput="searchData()" type="text" placeholder="Search courses..." class="bg-dark border border-gray-600 text-white rounded-lg px-4 py-2 flex-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Courses Table -->
                <div id="courseData" data-courses="<?php echo htmlspecialchars($courseDataJson, ENT_QUOTES, 'UTF-8'); ?>" class="bg-dark-lighter rounded-lg border border-gray-700 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Teacher Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <?php foreach($courses as $course): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white"><?php echo $course->title ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        <?php echo $course->category->name ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-white"><?php echo $course->teacher->username ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        <?php echo $course->type ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="showEditModal(<?php echo $course->id ?>)" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</button>
                                    <button onclick="deleteCourse(<?php echo $course->id ?>)" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-400">
                        Showing <?php echo ($page-1)*$perPage ?> to <?php echo ($page-1)*$perPage + count($courses) ?> of <?php echo count($courses) ?> courses
                    </div>
                    <div id="pagination" class="flex space-x-2">
                        <?php 
                            for($i=1;$i<=$totalPages;$i++){
                                if($i == $page){
                                    echo '<a class="px-3 py-1 bg-blue-600 text-white rounded">'.$i.'</a>';
                                }else{
                                    echo '<a href="javascript:void(0);" onclick="fetchData('.$i.')" class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-gray-600">'.$i.'</a>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-8 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Edit Course</h3>
                <form id="editCourseForm" class="space-y-6">
                    <input type="hidden" id="editCourseId" name="id">
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Course Title</label>
                        <input type="text" id="editTitle" name="title" 
                               class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm 
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                                      transition duration-150 ease-in-out">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="editCategory" name="category" required
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
                        <select id="editTags" name="tags[]" multiple 
                                class="mt-1 block w-full">
                            <?php foreach($tags as $tag): ?>
                                <option value="<?php echo $tag->id ?>"><?php echo $tag->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Course Description</label>
                        <textarea id="editDescription" name="description" required
                                class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm 
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                                       transition duration-150 ease-in-out min-h-[100px]"></textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Course Type</label>
                        <select id="editType" name="type" required
                                class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm 
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                                       transition duration-150 ease-in-out bg-white">
                            <option value="video">Video Course</option>
                            <option value="document">Document Course</option>
                        </select>
                    </div>

                    <!-- Dynamic Content Input -->
                    <div id="contentInput" class="space-y-2">
                        <!-- Will be populated dynamically based on course type -->
                    </div>

                    <div class="flex justify-end space-x-4 pt-4 mt-6 border-t border-gray-200">
                        <button type="button" onclick="closeEditModal()" 
                                class="px-6 py-2.5 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 
                                       transition duration-150 ease-in-out focus:outline-none focus:ring-2 
                                       focus:ring-gray-400 focus:ring-opacity-50">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-6 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 
                                       transition duration-150 ease-in-out focus:outline-none focus:ring-2 
                                       focus:ring-blue-500 focus:ring-opacity-50">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        let editor = null;
        let tagSelect = null;
        let courses = JSON.parse(document.getElementById('courseData').getAttribute('data-courses'));
        console.log(courses);
        // Initialize Choices.js
        document.addEventListener('DOMContentLoaded', function() {
            const tagsElement = document.getElementById('editTags');
            if (tagsElement) {
                tagSelect = new Choices(tagsElement, {
                    removeItemButton: true,
                    maxItemCount: 5,
                    searchEnabled: true,
                    searchPlaceholderValue: 'Search tags...',
                    placeholder: true,
                    placeholderValue: 'Select tags',
                    noChoicesText: 'No more tags available'
                });
            }

            // Handle course type changes
            document.getElementById('editType').addEventListener('change', function(e) {
                updateContentInput(e.target.value);
            });
        });

        function showEditModal(courseId) {
            const course = courses.find(c => c.id === courseId);
            if (!course) return;

            document.getElementById('editCourseId').value = course.id;
            document.getElementById('editTitle').value = course.title;
            document.getElementById('editCategory').value = course["category-id"];
            document.getElementById('editDescription').value = course.description;
            document.getElementById('editType').value = course.type;

            // Set selected tags using Choices.js
            if (tagSelect) {
                tagSelect.clearStore();
                tagSelect.clearChoices();
                
                const availableTags = <?php echo json_encode($tags); ?>;
                tagSelect.setChoices(availableTags.map(tag => ({
                    value: tag.id.toString(),
                    label: tag.name,
                    selected: course.tags.some(t => t.id === tag.id)
                })));
            }

            // Update content input based on course type
            updateContentInput(course.type).then(() => {
                if (course.type === 'video') {
                    document.getElementById('editContent').value = course.content;
                } else if (course.type === 'document') {
                    editor.setData($('<textarea/>').html(course.content).text());
                }
            });

            document.getElementById('editModal').classList.remove('hidden');
        }

        async function updateContentInput(type) {
            const contentInput = document.getElementById('contentInput');
            if (editor) {
                await editor.destroy();
                editor = null;
            }

            if (type === 'video') {
                contentInput.innerHTML = `
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Video URL</label>
                        <input type="url" id="editContent" name="content" 
                            class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm 
                                    focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                                    transition duration-150 ease-in-out">
                    </div>
                `;
            } else if (type === 'document') {
                contentInput.innerHTML = `
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Document Content</label>
                        <textarea id="editContent" name="content" 
                                class="mt-1 block w-full px-4 py-3 rounded-md border border-gray-300 shadow-sm 
                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 
                                        transition duration-150 ease-in-out min-h-[200px]"></textarea>
                    </div>
                `;
                // Initialize CKEditor
                editor = await ClassicEditor.create(document.querySelector('#editContent'));
            }
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            if (editor) {
                editor.destroy();
                editor = null;
            }
            if (tagSelect) {
                tagSelect.clearStore();
            }
        }

        document.getElementById('editCourseForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const courseId = formData.get('id');
            
            
            if (editor) {
                $('#documentContent').css('display', 'block');
                formData.set('content',editor.getData());
            }

            try {
                const response = await fetch(`/course/update`, {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Error updating course');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error updating course');
            }
        });

        

        function deleteCourse(id) {
            if (confirm('Are you sure you want to delete this course?')) {
                fetch(`/course/delete?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Error deleting course');
                        }
                    });
            }
        }        



        function fetchData(page) {
            var category = $('#categoryFilter').val();
            $.ajax({
                url: '/admin/courses',
                type: 'GET',
                data: { page: page, category: category },
                success: function(data) {
                    courses = JSON.parse($(data).find('#courseData').attr('data-courses'));
                    $('#courseData tbody').html($(data).find('#courseData tbody').html());
                    $('#pagination').html($(data).find('#pagination').html());
                },
                dataType: 'html'
            });
        }

        function searchData() {
            var term = $('#search').val();
            if(term) {
                $.ajax({
                    url: '/admin/courses',
                    type: 'GET',
                    data: { term: term },
                    success: function(data) {
                        $('#courseData tbody').html($(data).find('#courseData tbody').html());
                        $('#pagination').html("");
                    },
                    dataType: 'html'
                });
            } else {
                fetchData(1);
            }
        }
    </script>
</body>
</html>