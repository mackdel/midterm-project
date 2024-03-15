<?php
    class Database {
        // DB Params
        private $conn;
        private $host;
        private $port;
        private $dbname;
        private $username;
        private $password;
    

        public function __construct() {
            $this->username= getenv('USERNAME');
            $this->password= getenv('PASSWORD');
            $this->dbname= getenv('DBNAME');
            $this->host= getenv('HOST');
            $this->port= getenv('PORT');
        }
        

        // DB Connect
        public function connect() {
            if($this->conn){
                return $this->conn;
            } else {
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname};sslcert=blank;";

                // connect through PDO
                try {
                    $this->conn = new PDO($dsn, $this->username, $this->password);
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    return $this->conn;
                } catch (PDOException $e) {
                    echo 'Connection Error:' . $e->getMessage();
                }
            }
        }
    }
    /* class Database {
        // DB Params
        private $host = 'localhost';
        private $port = '5432';
        private $db_name = 'quotesdb';
        private $username =  'postgres';
        private $password = 'postgres';
        private $conn;

        // DB Connect
        public function connect() {
            $this->conn = null; 
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";

            // connect through PDO
            try {
                $this->conn = new PDO($dsn, $this->username, $this->password);

                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error:' . $e->getMessage();
            }

            return $this->conn;
        }
    } */