<?php
    namespace App\Database;

    class Database{

        private static ?Database $instance = NULL;
        private \PDO $connection;

        private function __construct()
        {
            $dsn = "pgsql:host=".$_ENV["DB_HOST"].";dbname=".$_ENV["DB_NAME"];
            $username = $_ENV["DB_USER"];
            $password = $_ENV["DB_PASS"];
            try{
                $this->connection = new \PDO($dsn,$username,$password);
                $this->connection->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

            }catch(\PDOException $e){
                die("connection Failed".$e->getMessage());
            }
        }
        public function getConnection(){
            return $this->connection;
        }
        public static function getInstance(){
            if(!self::$instance){
                self::$instance = new Database();
            }
            return self::$instance;
        }
    }