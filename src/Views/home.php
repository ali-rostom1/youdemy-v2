<?php 
    include "../src/Views/components/header.php";
?>
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gray-900">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-gray-900 sm:pb-16 md:pb-20 lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="text-center">
                        <h1 class="text-5xl tracking-tight font-extrabold text-white sm:text-6xl md:text-7xl">
                            <span class="block">Apprenez sans limites</span>
                            <span class="block text-blue-400">Évoluez avec passion</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-400 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl">
                            Rejoignez une communauté de passionnés et développez vos compétences avec des experts reconnus.
                        </p>
                        <div class="mt-8 flex justify-center gap-4">
                            <a href="/catalogue" class="px-8 py-4 rounded-full text-white bg-gradient-to-r from-blue-500 to-teal-400 hover:from-blue-600 hover:to-teal-500 font-medium text-lg">
                                Découvrir les cours
                            </a>
                            <a href="/authentification" class="px-8 py-4 rounded-full text-blue-400 bg-blue-500/10 hover:bg-blue-500/20 font-medium text-lg">
                                Devenir formateur
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-gradient-to-r from-blue-900/50 to-teal-900/50 border-y border-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-3">
                <div class="text-center">
                    <div class="text-4xl font-extrabold text-white">1000+</div>
                    <div class="mt-2 text-lg text-gray-400">Cours disponibles</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-extrabold text-white">50K+</div>
                    <div class="mt-2 text-lg text-gray-400">Étudiants actifs</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-extrabold text-white">200+</div>
                    <div class="mt-2 text-lg text-gray-400">Experts formateurs</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white text-center mb-12">Explorer par catégorie</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($categories as $category): ?>
                <div class="group relative rounded-2xl bg-gradient-to-br from-gray-800 to-gray-800/50 border border-gray-700 p-8 hover:from-blue-900/20 hover:to-teal-900/20 transition-all">
                    <div class="h-12 w-12 bg-blue-500 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2"><?php echo $category->name ?></h3>
                    <p class="text-gray-400"><?php echo $category->description ?></p>
                    <span class="mt-4 inline-block text-blue-400 font-medium"><?php echo $category->course_count ?> cours →</span>
                </div>
                <?php endforeach; ?>
                
                <!-- Repeat for other categories -->
            </div>
        </div>
    </div>

    <!-- Featured Courses -->
    <div class="py-20 bg-gray-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white text-center mb-12">Cours les plus populaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($courses as $course): ?>
                <div class="bg-gray-800 rounded-2xl overflow-hidden shadow-lg border border-gray-700 hover:shadow-2xl hover:shadow-blue-500/10 transition-shadow duration-300">
                    <div class="p-8">
                        <span class="px-4 py-2 rounded-full text-sm font-medium bg-blue-500/20 text-blue-300"><?php echo $course->category->name ?></span>
                        <h3 class="text-xl font-bold mt-4 mb-2 text-white"><?php echo $course->title ?></h3>
                        <p class="text-gray-400 mb-4"><?php echo $course->description ?></p>
                        <div class="flex items-center justify-between mt-6">
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
                <!-- Repeat for other courses -->
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-blue-900/50 to-teal-900/50 border-y border-gray-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white mb-4">Prêt à commencer votre voyage ?</h2>
                <p class="text-xl text-gray-400 mb-8">Rejoignez des milliers d'apprenants qui transforment leur vie avec Youdemy</p>
                <a href="#" class="inline-block px-8 py-4 rounded-full bg-gradient-to-r from-blue-500 to-teal-400 text-white font-medium text-lg hover:from-blue-600 hover:to-teal-500">
                    Commencer gratuitement
                </a>
            </div>
        </div>
    </div>

    <?php include "../src/Views/components/footer.php"; ?>
    <script>
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
    </script>
</body>
</html>