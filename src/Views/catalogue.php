<?php 
    include "../src/Views/components/header.php";
?>
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-900/50 to-teal-900/50 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-4xl font-bold text-white">Catalogue des cours</h1>
            <p class="mt-2 text-gray-400">Découvrez notre sélection de cours pour développer vos compétences</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search and Filters Bar -->
        <div class="flex flex-col md:flex-row gap-4 mb-8 justify-end">
            <div >
                <div class="relative">
                    <input type="search" id="search" oninput="searchData()" placeholder="Rechercher un cours..." class="w-full pl-4 pr-10 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button class="absolute right-3 top-3 text-gray-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        

        <div class="grid grid-cols-12 gap-8">
            <!-- Sidebar Filters -->
            <div class="col-span-12 md:col-span-3 space-y-6">
                <!-- Categories -->
                <div class="bg-gray-800/50 rounded-lg p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4">Catégories</h3>
                    <div class="space-y-3">
                        <?php foreach($categories as $category) :?>
                        <label class="flex items-center text-gray-300">
                            <input onclick="fetchData(1)" name="category" type="radio" value="<?php echo $category->id ?>" class="form-checkbox rounded text-blue-500 bg-gray-700 border-gray-600">
                            <span  class="ml-2"><?php echo $category->name.'('.$category->course_count.')' ?></span>
                        </label>
                        <?php endforeach; ?>
                        <!-- Add more categories -->
                    </div>
                </div>

                <!-- Tags -->
                <div class="bg-gray-800/50 rounded-lg p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4">Tags populaires</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach($tags as $tag) : ?>
                        <button  data-value="<?php echo $tag->id ?>" class="tag px-3 py-1 rounded-full text-sm bg-gray-700 text-gray-300 hover:bg-gray-600">
                            <?php echo $tag->name; ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Content Type Filter -->
                <div class="bg-gray-800/50 rounded-lg p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4">Type de contenu</h3>
                    <div class="space-y-3">
                        <label class="flex items-center text-gray-300">
                            <input onclick="fetchData(1)" type="checkbox" name="type" value="video" class="form-checkbox rounded text-blue-500 bg-gray-700 border-gray-600">
                            <span class="ml-2">Vidéo (<?php echo $videoCoursesCount ?>)</span>
                        </label>
                        <label class="flex items-center text-gray-300">
                            <input type="checkbox" onclick="fetchData(1)" name="type" value="document" class="form-checkbox rounded text-blue-500 bg-gray-700 border-gray-600">
                            <span class="ml-2">Document (<?php echo $documentCoursesCount ?>)</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Course Grid -->
            <div class="col-span-12 md:col-span-9">
                <!-- Sort Bar -->
                
                <!-- Course Cards -->
                <div id="coursesData" data-courses='<?php echo htmlspecialchars($courseDataJson, ENT_QUOTES, 'UTF-8'); ?>' class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Course Card -->
                     <?php foreach($courses as $course) : ?>
                    <div data-value="<?php echo $course->id ?>" class="course-card bg-gray-800 rounded-lg overflow-hidden border border-gray-700 hover:shadow-lg hover:shadow-blue-500/10 transition-shadow">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3 flex-wrap">
                                <?php foreach($course->tags as $index=>$tag) : ?>
                                    <?php if($index<3) : ?>
                                        <?php if($index%2 === 0) :?>
                                        <span class="px-2 py-1 rounded text-xs font-medium bg-blue-500/20 text-blue-300">
                                            <?php echo $tag->name; ?>
                                        </span>
                                        <?php else :?>
                                            <span class="px-2 py-1 rounded text-xs font-medium bg-blue-500/20 text-green-300">
                                            <?php echo $tag->name; ?>
                                        </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach;?>
                                <span class="px-2 py-1 rounded text-xs font-medium bg-purple-500/20 text-purple-300">
                                            <?php echo $course->type; ?>
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2"><?php echo $course->title; ?></h3>
                            <p class="text-gray-400 text-sm mb-4"><?php echo $course->description; ?></p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-medium">
                                        <?php 
                                            echo $course->teacher->getLogoName();
                                        ?>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-400"><?php echo $course->teacher->username ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <!-- Repeat course cards -->
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    <nav id="pagination" class="flex gap-2">
                        <?php 
                            for($i=1;$i<=$totalPages;$i++){
                                if($i == $page){
                                    echo '<button class="px-4 py-2 rounded-lg bg-blue-500 text-white">'.$i.'</button>';
                                }else{
                                    echo '<a href="javascript:void(0)" onclick="fetchData('.$i.')" class="px-4 py-2 rounded-lg bg-gray-800 text-gray-400 hover:bg-gray-700">'.$i.'</a>';
                                } 
                            }
                        ?>
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="courseModal" class="fixed inset-0 bg-gray-900/80 hidden backdrop-blur-sm" onclick="closeModal()">
        <div class="fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg bg-gray-800 rounded-lg border border-gray-700 p-6" onclick="event.stopPropagation()">
            <!-- Modal Header with Close Button -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-white" id="modalCourseName"></h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Course Details -->
            <div class="space-y-4">
                <!-- Tags -->
                <div class="flex flex-wrap gap-2" id="modalTags">
                    <!-- Tags will be inserted here -->
                </div>

                <!-- Category -->
                <div>
                    <span class="text-gray-400">Catégorie:</span>
                    <span class="text-white ml-2" id="modalCategory"></span>
                </div>

                <!-- Description -->
                <p class="text-gray-300" id="modalDescription"></p>

                <!-- Type -->
                <div>
                    <span class="text-gray-400">Type:</span>
                    <span class="text-white ml-2" id="modalType"></span>
                </div>

                <!-- Teacher -->
                <div>
                    <span class="text-gray-400">Enseignant:</span>
                    <span class="text-white ml-2" id="modalTeacher"></span>
                </div>

                <!-- Sign Up Button -->
                <button id="signUp" href="#" class="w-full mt-6 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    S'inscrire au cours
                </button>
            </div>
        </div>
    </div>

    <style>
        .modal-tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background-color: rgba(59, 130, 246, 0.2);
            color: rgb(147, 197, 253);
            border-radius: 9999px;
            font-size: 0.875rem;
        }
    </style>
    <?php include "../src/Views/components/footer.php"; ?>
    <script>
        //burger Menu
        function toggleMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) { 
                const mobileMenu = document.getElementById('mobile-menu');
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
        
        let courses = JSON.parse(document.getElementById('coursesData').getAttribute('data-courses'));
        console.log(courses);
        var selectedTag = null; 
        $(document).on('click', '.tag', function() { 
            selectedTag = $(this).data('value'); 
            fetchData(1); 
        });
        function fetchData(page) {
            var category = $('input[name="category"]:checked').val();
            var type = $('input[name="type"]:checked').length === 1 ? $('input[name="type"]:checked').val() : "";
            var tag = selectedTag;
            
            $.ajax({ 
                url: '/catalogue', 
                type: 'GET', 
                data: { page: page, category: category ,type: type, tag: tag}, 
                success: function(data) {
                    courses = JSON.parse($(data).find('#coursesData').attr('data-courses'));
                    $('#coursesData').html($(data).find('#coursesData').html()); 
                    $('#pagination').html($(data).find('#pagination').html());
                    $('#total').html($(data).find('#total').html());
                    initEventHandlers();
                }, 
                dataType: 'html'
            }); 
        }
        function searchData() {
            var term = $('#search').val();
            if(term){
                $.ajax({ 
                    url: '/catalogue', 
                    type: 'GET', 
                    data: { term: term}, 
                    success: function(data) {
                        courses = JSON.parse($(data).find('#coursesData').attr('data-courses'));
                        $('#coursesData').html($(data).find('#coursesData').html());
                        $('#total').html($(data).find('#total').html());
                        $('#pagination').html("");
                        initEventHandlers();
                    }, 
                    dataType: 'html'
                });
            }else{
                fetchData(1);
            } 
        }
        const role = '<?php echo $user ? $user->role : NULL ?>';
        function initEventHandlers(){
            $(document).on('click', '.course-card', function() { 
                const id = $(this).data('value'); 
                const course = courses.find(course => course.id == id); 
                showModal(course); 
            });
            $(document).on('click', '#closeModal', function() { 
                closeModal(); 
            });
        }
        

        function showModal(courseData) {
            if(role === "student"){
                const modal = $('#courseModal');
                const tagsContainer = $('#modalTags');
                
                tagsContainer.empty();
                console.log(courseData);
                
                courseData.tags.forEach(tag => {
                    const tagElement = $('<span></span>').addClass('modal-tag px-2 py-1 rounded text-xs font-medium bg-gray-200 text-gray-700 mr-2').text(tag.name);
                    tagsContainer.append(tagElement);
                });
                $('#modalCourseName').text(courseData.title);
                $('#modalCategory').text(courseData.category);
                $('#modalDescription').html(courseData.description); 
                $('#modalType').text(courseData.type);
                $('#modalTeacher').text(courseData.teacher);
                $('#signUp').off("click").on("click",function(){
                    window.location.href="/course/signup?id="+courseData.id;
                })

                modal.removeClass('hidden');

                $('body').css('overflow', 'hidden');
            }else{
                window.location.href = "/authentification";
            }
        }

        function closeModal() {
            $('#courseModal').addClass('hidden');
            $('body').css('overflow', '');
        }

        initEventHandlers();
        if (<?php echo isset($_GET["error"]) ? 1 : 0 ?>) {
            Swal.fire({
                title: 'Error!',
                text: 'You are already enrolled to this course!',
                icon: 'error',
                confirmButtonText: 'okay'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = window.location.pathname;
                }
            });
        }else if(<?php echo isset($_GET["success"]) ? 1 : 0 ?>) {
            Swal.fire({
                title: 'You have Been enrolled to the course',
                text: 'Do you want to continue',
                icon: 'success',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = window.location.pathname;
                }
            });
        }

    </script>
</body>
</html>
