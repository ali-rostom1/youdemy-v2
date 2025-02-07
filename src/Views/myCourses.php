<?php 
    include "../src/Views/components/header.php";
?>
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search -->
        <div class="mb-8">
            <input id="search" oninput="searchData()" type="search" placeholder="Rechercher dans mes cours..." class="w-full pl-4 pr-10 py-3 bg-gray-800 border border-gray-600 text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Course Grid -->
        <div id="coursesData" data-courses='<?php htmlspecialchars($courseDataJson, ENT_QUOTES, 'UTF-8') ?>' class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Course Card -->
            <?php foreach($courses as $course) :?>
            <div data-value="<?php echo $course->id ?>" class="course-card bg-gray-800 rounded-lg overflow-hidden border border-gray-600 hover:shadow-lg hover:shadow-blue-500/10 transition-shadow cursor-pointer">
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <?php foreach($course->tags as $index=>$tag) :?>
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
                        <?php endforeach; ?>
                    </div>
                    <h3 class="text-lg font-bold text-gray-100 mb-2"><?php echo $course->title ?></h3>
                    <p class="text-gray-300">Par <?php echo $course->teacher->username ?></p>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>

    <!-- Course Details Modal -->
    <div id="courseModal" class="fixed inset-0 bg-gray-900/90 hidden backdrop-blur-sm overflow-y-auto p-4 md:p-8" onclick="closeModal()">
        <div class="my-8 mx-auto max-w-4xl bg-gray-800 rounded-xl border border-gray-600 shadow-2xl" onclick="event.stopPropagation()">
            <!-- Modal Header -->
            <div class="p-8 border-b border-gray-600 bg-gray-750 rounded-t-xl">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-100" id="modalCourseName"></h3>
                        <div class="flex flex-wrap gap-2 mt-2" id="modalTags"></div>
                    </div>
                    <button onclick="closeModal()" class="text-gray-300 hover:text-white bg-gray-700 p-2 rounded-lg hover:bg-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-8 bg-gray-850">
                <!-- Course Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-750 p-6 rounded-xl">
                        <span class="text-gray-300 block mb-1">Catégorie</span>
                        <span class="text-gray-100 font-medium" id="modalCategory"></span>
                    </div>
                    <div class="bg-gray-750 p-6 rounded-xl">
                        <span class="text-gray-300 block mb-1">Type</span>
                        <span class="text-gray-100 font-medium" id="modalType"></span>
                    </div>
                    <div class="bg-gray-750 p-6 rounded-xl">
                        <span class="text-gray-300 block mb-1">Enseignant</span>
                        <span class="text-gray-100 font-medium" id="modalTeacher"></span>
                    </div>
                </div>

                <!-- Description -->
                <p class="text-gray-200 mb-8" id="modalDescription"></p>

                <!-- Document Content -->
                <div id="documentContent" class="hidden bg-slate-900 rounded-md">
                    <div class="bg-gray-750 rounded-xl p-8">
                        <div class="prose prose-invert max-w-none text-gray-200">
                            <!-- Document content will be inserted here -->
                        </div>
                    </div>
                </div>
                <div id="videoContent">

                </div>
            </div>
        </div>
    </div>

    <script>
        let courses = <?php echo $courseDataJson ?>;
        
        function showCourseDetails(courseData) {
            const $modal = $('#courseModal');
            const $tagsContainer = $('#modalTags');
            const $documentContent = $('#documentContent');
            // Clear existing tags
            $tagsContainer.empty();
            console.log(courseData.content);

            // Add tags
            $.each(courseData.tags, function(index, tag) {
                const $tagElement = $('<span></span>')
                    .addClass('px-2 py-1 rounded text-xs font-medium bg-blue-500/20 text-blue-300')
                    .text(tag.name);
                $tagsContainer.append($tagElement);
            });

            // Update course info
            $('#modalCourseName').text(courseData.title);
            $('#modalCategory').text(courseData.category);
            $('#modalDescription').text(courseData.description);
            $('#modalType').text(courseData.type);
            $('#modalTeacher').text(courseData.teacher);

            decodedContent = $('<textarea/>').html(courseData.content).text();
            
            
            // Show document content
            $documentContent.removeClass('hidden');
            $documentContent.find('.prose').html(decodedContent);

            // Show modal
            $modal.removeClass('hidden');
            $('body').css('overflow', 'hidden');
        }

        function closeModal() {
            $('#courseModal').addClass('hidden');
            $('body').css('overflow', '');
        }
        function fetchData(){
            $.ajax({ 
                    url: '/myCourses', 
                    type: 'GET', 
                    data: {}, 
                    success: function(data) {
                        courses = JSON.parse($(data).find('#coursesData').attr('data-courses'));
                        $('#coursesData').html($(data).find('#coursesData').html());
                        initEventHandlers();
                    }, 
                    dataType: 'html'
                });
        }
        function searchData() {
            var term = $('#search').val();
            if(term){
                $.ajax({ 
                    url: '/myCourses', 
                    type: 'GET', 
                    data: { term: term}, 
                    success: function(data) {
                        courses = JSON.parse($(data).find('#coursesData').attr('data-courses'));
                        $('#coursesData').html($(data).find('#coursesData').html());
                        initEventHandlers();
                    }, 
                    dataType: 'html'
                });
            } else {
                fetchData();
            }
        }

        function initEventHandlers(){
            $(document).on('click', '.course-card', function() { 
                const id = $(this).data('value'); 
                const course = courses.find(course => course.id == id); 
                showCourseDetails(course); 
            });
            $(document).on('click', '#closeModal', function() { 
                closeModal(); 
            });
        }

        $(document).ready(function() {
            initEventHandlers();
        });
    </script>
</body>
</html>