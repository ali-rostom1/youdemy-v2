<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="icon" type="image/svg+xml" href="assets/images/icons/favicon.svg">
    <link rel="alternate icon" type="image/png" href="/favicon.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
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
                <a href="/admin/courses" class="flex items-center px-6 py-3 text-gray-400 hover:bg-gray-700 hover:text-white transition-colors">
                    <span class="inline-block mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </span>
                    Courses
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-100 bg-gray-700">
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
                    <h2 class="text-2xl font-semibold text-white">Category Management</h2>
                    <button onclick="showAddCategoryModal()" class="px-4 py-2 text-gray-100 bg-green-600 rounded-lg hover:bg-green-700 transition-colors inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New Category
                    </button>
                    <a href="/logout" class="px-4 py-2 text-gray-100 bg-red-600 rounded-lg hover:bg-red-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="bg-dark-lighter rounded-lg p-6 border border-gray-700 mb-8">
                    <div class="flex items-center">
                        <input id="search" oninput="searchData()" type="text" placeholder="Search categories..." class="bg-dark border border-gray-600 text-white rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Categories Table -->
                <div id="categoryData" data-categories="<?php echo htmlspecialchars($categoriesDataJson,ENT_QUOTES,'UTF-8'); ?>" class="bg-dark-lighter rounded-lg border border-gray-700 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Course Count</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <?php foreach($categories as $category): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white"><?php echo $category->name ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-400"><?php echo $category->course_count ?> courses</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="editCategory(<?php echo $category->id ?>)" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Edit</button>
                                    <button onclick="deleteCategory(<?php echo $category->id ?>)" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-400">
                        Showing <?php echo ($page-1)*$perPage ?> to <?php echo ($page-1)*$perPage + count($categories) ?> of <?php echo count($categories) ?> categories
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

                <!-- Add/Edit Category Modal -->
                <div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                    <div class="bg-dark-lighter rounded-lg p-6 w-96">
                        <h3 class="text-xl font-semibold text-white mb-4" id="modalTitle">Add New Category</h3>
                        <input type="hidden" id="categoryId">
                        <input type="text" id="categoryName" placeholder="Category name" class="bg-dark border border-gray-600 text-white rounded-lg px-4 py-2 w-full mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <textarea id="categoryDescription" id="categoryDescription" placeholder="Category description" class="bg-dark border border-gray-600 text-white rounded-lg px-4 py-2 w-full mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        <div class="flex justify-end space-x-3">
                            <button onclick="closeModal()" class="px-4 py-2 text-gray-400 hover:text-white transition-colors">Cancel</button>
                            <button onclick="saveCategory()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        let categories = <?php echo $categoriesDataJson ?>;
        console.log(categories);
        function showAddCategoryModal() {
            document.getElementById('modalTitle').textContent = 'Add New Category';
            document.getElementById('categoryId').value = '';
            document.getElementById('categoryName').value = '';
            document.getElementById('categoryDescription').value = '';
            document.getElementById('categoryModal').classList.remove('hidden');
            document.getElementById('categoryModal').classList.add('flex');
        }

        function editCategory(id) {
            category = categories.find( c => c.id === id);
            document.getElementById('modalTitle').textContent = 'Edit Category';
            document.getElementById('categoryId').value = category.id;
            document.getElementById('categoryName').value = category.name;
            document.getElementById('categoryDescription').value = category.description;
            document.getElementById('categoryModal').classList.remove('hidden');
            document.getElementById('categoryModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('categoryModal').classList.add('hidden');
            document.getElementById('categoryModal').classList.remove('flex');
        }

        async function saveCategory() {
            const id = document.getElementById('categoryId').value;
            const name = document.getElementById('categoryName').value;
            const description = document.getElementById('categoryDescription').value;

            $.ajax({
                type: "POST",
                url: '/admin/category/update',
                data: {
                    id: id,
                    name: name,
                    description: description
                },
                success: function(data){
                    if(data.success) {
                        closeModal();
                        fetchData(1);
                    }else{
                        alert('An error occurred while saving the category.');
                    }
                },
                dataType: 'json'
            });
            
        }

        function deleteCategory(id) {
            if(confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
                $.get('/admin/category/delete?id=' + id, function(data) {
                    if(data.success) {
                        fetchData(1);
                    }else{
                        alert('An error occurred while deleting the category.');
                    }
                },"json");
            }
        }

        function fetchData(page) {
            $.ajax({
                url: '/admin/category',
                type: 'GET',
                data: { page: page },
                success: function(data) {
                    categories = JSON.parse($(data).find('#categoryData').attr('data-categories'));
                    $('#categoryData tbody').html($(data).find('#categoryData tbody').html());
                    $('#pagination').html($(data).find('#pagination').html());
                },
                dataType: 'html'
            });
        }

        function searchData() {
            var term = $('#search').val();
            if(term) {
                $.ajax({
                    url: '/admin/category',
                    type: 'GET',
                    data: { term: term },
                    success: function(data) {
                        categories = $(data).find('#categoryData').attr('data-categories');
                        $('#categoryData tbody').html($(data).find('#categoryData tbody').html());
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