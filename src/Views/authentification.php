<?php 
    include "../src/Views/components/header.php";
?>
    
    <!-- Background Pattern -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_120%,rgba(59,130,246,0.1),rgba(59,130,246,0)_50%)]"></div>
        <div class="absolute right-0 -top-40 w-[500px] h-[500px] bg-blue-500/30 rounded-full blur-[128px]"></div>
        <div class="absolute left-0 -bottom-40 w-[500px] h-[500px] bg-teal-500/30 rounded-full blur-[128px]"></div>
    </div>

    <!-- Login/Register Section -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo and Welcome Text -->
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white mb-2">Bienvenue sur Youdemy</h1>
                <p class="text-gray-400">Votre parcours d'apprentissage commence ici</p>
            </div>

            <div class="bg-gray-800/50 backdrop-blur-xl p-8 rounded-2xl border border-gray-700/50 shadow-xl">
                <!-- Tabs -->
                <div class="flex p-1 bg-gray-700/30 rounded-lg mb-8">
                    <button onclick="switchTab('login')" id="login-tab" class="flex-1 py-3 px-4 rounded-md text-white font-medium bg-gradient-to-r from-blue-500 to-teal-400">Connexion</button>
                    <button onclick="switchTab('register')" id="register-tab" class="flex-1 py-3 px-4 rounded-md text-gray-300 font-medium hover:bg-gray-700/50">Inscription</button>
                </div>

                <!-- Login Form -->
                <div id="login-form" class="space-y-6">
                    <form id="login" class="space-y-4" action="/login" method="POST">
                        <div>
                            <label for="login-email" class="text-sm font-medium text-gray-300">Adresse email</label>
                            <div class="mt-1 relative">
                                <input id="login-email" name="loginEmail" type="email"  class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none">
                                <div class="absolute left-4 top-3.5 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="login-password" class="text-sm font-medium text-gray-300">Mot de passe</label>
                            <div class="mt-1 relative">
                                <input id="login-password" name="loginPassword" type="password" class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none">
                                <div class="absolute left-4 top-3.5 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-500 bg-gray-800 border-gray-700 rounded">
                                <span class="ml-2 text-sm text-gray-300">Se souvenir de moi</span>
                            </label>
                            <a href="#" class="text-sm text-blue-400 hover:text-blue-300">Mot de passe oublié ?</a>
                        </div>

                        <button type="submit" class="w-full py-3 px-4 rounded-lg text-white bg-gradient-to-r from-blue-500 to-teal-400 hover:from-blue-600 hover:to-teal-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-medium transition-all duration-200">
                            Se connecter
                        </button>
                    </form>
                </div>

                <!-- Register Form -->
                <div id="register-form" class="hidden space-y-6">
                    <form id="register" class="space-y-4" action="/register" method="POST">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="register-firstname" class="text-sm font-medium text-gray-300">Prénom</label>
                                <input id="register-firstname" type="text" name="registerFname"  class="mt-1 w-full px-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none">
                            </div>
                            <div>
                                <label for="register-lastname" class="text-sm font-medium text-gray-300">Nom</label>
                                <input id="register-lastname" name="registerLname" type="text"  class="mt-1 w-full px-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none">
                            </div>
                        </div>
                        
                        <div>
                            <label for="register-email" class="text-sm font-medium text-gray-300">Adresse email</label>
                            <div class="mt-1 relative">
                                <input id="register-email" name="registerEmail" type="email"  class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none">
                                <div class="absolute left-4 top-3.5 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a9 9 0 01-4.5 1.207"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="register-password" class="text-sm font-medium text-gray-300">Mot de passe</label>
                            <div class="mt-1 relative">
                                <input id="register-password" name="registerPassword" type="password"  class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none ">
                                <div class="absolute left-4 top-3.5 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-300">Êtes-vous un enseignant ou un étudiant ?</label>
                            <div class="mt-1 space-x-4">
                                <label class="inline-flex items-center text-gray-300">
                                    <input type="radio" name="user-type" value="teacher" class="w-4 h-4 text-blue-500 bg-gray-800 border-gray-700 rounded" required>
                                    <span class="ml-2 text-sm">Enseignant</span>
                                </label>
                                <label class="inline-flex items-center text-gray-300">
                                    <input type="radio" name="user-type" value="student" class="w-4 h-4 text-blue-500 bg-gray-800 border-gray-700 rounded" required checked>
                                    <span class="ml-2 text-sm">Étudiant</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-500 bg-gray-800 border-gray-700 rounded">
                                <span class="ml-2 text-sm text-gray-300">Se souvenir de moi</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full py-3 px-4 rounded-lg text-white bg-gradient-to-r from-blue-500 to-teal-400 hover:from-blue-600 hover:to-teal-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-medium transition-all duration-200">
                            S'inscrire
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "../src/Views/components/footer.php"; ?>
    <script>
        function switchTab(tab) {
            if (tab === 'login') {
                document.getElementById('login-form').classList.remove('hidden');
                document.getElementById('register-form').classList.add('hidden');
                document.getElementById('login-tab').classList.add('bg-gradient-to-r', 'from-blue-500', 'to-teal-400');
                document.getElementById('register-tab').classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-teal-400');
                document.getElementById('register-tab').classList.add('text-gray-300', 'hover:bg-gray-700/50');
            } else if (tab === 'register') {
                document.getElementById('register-form').classList.remove('hidden');
                document.getElementById('login-form').classList.add('hidden');
                document.getElementById('register-tab').classList.add('bg-gradient-to-r', 'from-blue-500', 'to-teal-400');
                document.getElementById('login-tab').classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-teal-400');
                document.getElementById('login-tab').classList.add('text-gray-300', 'hover:bg-gray-700/50');
            }
        }
        let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        let passRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

        let nameRegex = /^[a-zA-Z\s'-]{3,20}$/;

        function dynamicInputValidation(input,regex){
            input.addEventListener('input',()=>{
                if(regex.test(input.value)){
                    input.classList.add('border-green-500');
                    input.classList.remove('border-red-500');
                }else{
                    input.classList.add('border-red-500');
                    input.classList.remove('border-green-500');
                }
            })
        }
        function inputValidation(input,regex){
            return regex.test(input.value);
        }
        
        loginEmailInput = document.getElementById('login-email');
        loginPasswordInput = document.getElementById('login-password');
        registerFirstName = document.getElementById('register-firstname');
        registerLastName = document.getElementById('register-lastname');
        registerEmail = document.getElementById('register-email');
        registerPassword = document.getElementById('register-password');

        dynamicInputValidation(loginEmailInput,emailRegex);
        dynamicInputValidation(loginPasswordInput,passRegex);
        dynamicInputValidation(registerFirstName,nameRegex);
        dynamicInputValidation(registerLastName,nameRegex);
        dynamicInputValidation(registerEmail,emailRegex);
        dynamicInputValidation(registerPassword,passRegex);

        document.getElementById("register").addEventListener("submit",(event)=>{
            event.preventDefault();
            if(inputValidation(registerFirstName,nameRegex) && inputValidation(registerLastName,nameRegex) && inputValidation(registerEmail,emailRegex) && inputValidation(registerPassword,passRegex)){
                document.getElementById("register").submit();
            }
        })
        document.getElementById("login").addEventListener("submit",(event)=>{
            event.preventDefault();
            if(inputValidation(loginEmailInput,emailRegex) && inputValidation(loginPasswordInput,passRegex)){
                document.getElementById("login").submit();
            }
        })
    </script>
</body>
</html>