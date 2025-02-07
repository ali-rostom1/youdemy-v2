<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Youdemy</title>
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/output.css">
    <link rel="icon" type="image/svg+xml" href="../assets/images/icons/favicon.svg">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
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
                <a href="#" class="flex items-center px-6 py-3 text-gray-100 bg-gray-700">
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
                    <h2 class="text-2xl font-semibold text-white">User Management</h2>
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
                        <label class="text-gray-400">Filter by Role:</label>
                        <select id="filter" onchange="fetchData(1)" class="bg-dark border border-gray-600 text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" >
                            <option value="" >All Users</option>
                            <option value="student">Students</option>
                            <option value="teacher">Teachers</option>
                        </select>
                        <input id="search" oninput="searchData()" type="text" placeholder="Search users..."  class="bg-dark border border-gray-600 text-white rounded-lg px-4 py-2 flex-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Users Table -->
                <div id="userData" class="bg-dark-lighter rounded-lg border border-gray-700 overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Joined Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            <?php foreach($users as $user):?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-white"><?php echo $user->username; ?></div>
                                            <div class="text-sm text-gray-400"><?php echo $user->email; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full<?php if($user->role === "teacher") echo " bg-purple-100 text-purple-800"; else echo " bg-blue-100 text-blue-800"?>">
                                        <?php echo $user->role ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php 
                                        if($user->status === "pending") echo "bg-yellow-100 text-yellow-800";
                                        else if($user->status === "active") echo "bg-green-100 text-green-800";
                                        else if($user->status === "banned") echo "bg-red-100 text-red-800";
                                        else if($user->status === "suspended") echo "bg-orange-100 text-orange-800";
                                    ?>
                                    ">
                                        <?php echo $user->status ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                    <?php echo $user->createdAt->format("d M Y")  ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <?php
                                        switch($user->status){
                                            case "active":
                                                echo '<button onclick="suspend('.$user->id.')" class="px-3 py-1 bg-yellow-600 text-white rounded hover:bg-yellow-700">Suspend</button>
                                                        <button onclick="ban('.$user->id.')" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Ban</button>';
                                                break;
                                            case "banned":
                                                echo '<button onclick="pardon('.$user->id.')" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Pardon</button>';
                                                break;
                                            case "suspended":
                                                echo '<button onclick="pardon('.$user->id.')" class="px-3 py-1 bg-yellow-600 text-white rounded hover:bg-yellow-700">Unsuspend</button>
                                                    <button onclick="ban('.$user->id.')" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Ban</button>';
                                                break;
                                            case "pending":
                                                echo '<button onclick="approve('.$user->id.')" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">Approve</button>';

                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-400">
                    Showing <?php echo ($page-1)*$perPage ?> to <?php echo ($page-1)*$perPage + count($users) ?> of <?php echo count($users) ?> users
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
    <script>
        function fetchData(page) {
            var role = $('#filter').val();
            $.ajax({ 
                url: '/admin/users', 
                type: 'GET', 
                data: { page: page, role: role}, 
                success: function(data) { 
                    $('#userData tbody').html($(data).find('#userData tbody').html()); 
                    $('#pagination').html($(data).find('#pagination').html());
                }, 
                dataType: 'html'
            }); 
        }
        function searchData() {
            var term = $('#search').val();
            if(term){
                $.ajax({ 
                    url: '/admin/users', 
                    type: 'GET', 
                    data: { term: term}, 
                    success: function(data) { 
                        $('#userData tbody').html($(data).find('#userData tbody').html());
                        $('#pagination').html("");
                    }, 
                    dataType: 'html'
                });
            }else{
                fetchData(1);
            } 
        }
        async function ban(id){
            try{
                const response = await fetch("/ban?id="+id);
                const data = await response.json();
                console.log(data);
                if(data.success){
                    window.location.reload();
                }else {
                    alert('Error  banning user');
                }
            }catch(error){
                console.log(error);
                alert("error Banning user id : "+id);
            }
        }
        async function pardon(id){
            try{
                const response = await fetch("/approve?id="+id);
                const data = await response.json();
                if(data.success){
                    window.location.reload();
                }else {
                    alert('Error  unbanning user');
                }
            }catch(error){
                console.log(error);
                alert("error unBanning user id : "+id);
            }
        }
        async function suspend(id){
            try{
                const response = await fetch("/suspend?id="+id);
                const data = await response.json();
                if(data.success){
                    window.location.reload();
                }else {
                    alert('Error  suspending user');
                }
            }catch(error){
                console.log(error);
                alert("error suspending user id : "+id);
            }
        }
        async function approve(id){
            try{
                const response = await fetch("/approve?id="+id);
                const data = await response.json();
                if(data.success){
                    window.location.reload();
                }else {
                    alert('Error  approving user');
                }
            }catch(error){
                console.log(error);
                alert("error approving user id : "+id);
            }
        }
    </script>
</body>
</html>