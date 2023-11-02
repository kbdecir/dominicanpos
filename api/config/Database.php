<?php
    class dbclass {
        private $conn;
        private $host = 'localhost';
        private $dbName = 'dominicanpos';
        private $userName = 'root';
        private $psw = '';

        public function getconnection() {
            try
            {
            $this->conn=new PDO("mysql:host=" .  $this->host . ";port=3308;dbname=" . $this->dbName . ";" , $this->userName, $this->psw);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        
        }
    }
?>