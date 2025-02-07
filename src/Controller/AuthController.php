<?php

    namespace App\Controller;

    use App\DAO\UserDAO;
    use App\Service\Authentification;

    class AuthController{
        private Authentification $auth;
        private UserDAO $userDAO;

        public function __construct()
        {
            $this->auth = new Authentification();
            $this->userDAO = new UserDAO();
        }
        public function login() : void
        {
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $email = $_POST["loginEmail"];
                $password = $_POST["loginPassword"];
                $user = $this->auth->login($email,$password);
                if($user)
                {
                    switch($user->role)
                    {
                        case "teacher":
                            header("location: /catalogue");
                            break;
                        case "student":
                            header("location: /");
                            break;
                        case "admin":
                            header("location: /admin/dashboard");
                            break;
                        default:
                            header("/authentification");
                            break;
                    }
                    exit;
                }else{
                    header("location: /authentification");
                    exit;
                }
            }
        }
        public function index() : void
        {
            if(!$this->auth->isAuthenticated()){
                include "../src/Views/authentification.php";
            }else if($this->auth->isAdmin()){
                header("location: /admin/dashboard");
                exit;
            }else{
                header("location: /catalogue");
                exit;
            }
        }
        public function logout() : void
        {
            $this->auth->logout();
            header("location: /authentification");
            exit;
        }
        public function register() : void
        {
            if($this->auth->isAuthenticated()){
                $this->index();
            }
            $username = $_POST["registerFname"]. " " . $_POST["registerLname"];
            $email = $_POST["registerEmail"];
            $password = $_POST["registerPassword"];
            $role = $_POST["user-type"];
            if(!$this->auth->register($username,$password,$email,$role)){
                header("location: /authentification?error=" . urlencode("Invalid inputs!"));
                exit;
            }else{
                header("location: /authentification?success");
            }
        }
        public function redirection() : void
        {
            if($this->auth->isAuthenticated() && !$this->auth->isActive()){
                $user = $this->auth->getCurrentUser();
                switch($user->status){
                    case "banned":
                        include "../src/Views/status/banned.php";
                        break;
                    case "suspended":
                        include "../src/Views/status/suspended.php";
                        break;
                    case "pending":
                        include "../src/Views/status/pending.php";
                        break;
                    default:
                        break;    
                }
            }
        }
    }