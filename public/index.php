<?php 

    require_once "../vendor/autoload.php";

    use App\Database\Database;
    use App\Router;
    use Dotenv\Dotenv;
    

    //LOADING ENVIROMENT VARIABLES    
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();

    //INITIALIZING ROUTER
    $router = new Router();
    
    
    
