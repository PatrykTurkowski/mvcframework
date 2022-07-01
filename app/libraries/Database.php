<?php
    class Database {
        private $dbHost = DB_HOST;
        private $dbUser = DB_USER;
        private $dbPass = DB_PASS;
        private $dbName = DB_NAME;

        private $statment;
        private $dbHandler;
        private $error;

        public function __construct()
        {
            $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
            $options = array(
                PDO::ATTR_PERSISTENT =>true,
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            );
            try{
                $this->dbHandler = new PDO($conn,$this->dbUser,$this->dbPass,$options); 
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        public function query($sql) :void {
            $this->statment = $this->dbHandler->prepare($sql);
        }

        public function bind($parameter, $value, $type = null) {
            switch (is_null($type)) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
            $this->statment->bindValue($parameter,$value,$type);
        }

        public function execute(){
            return $this->statment->execute();
        }

        public function resultSet(){
            $this->execute();
            return $this->statment->fetchAll(PDO::FETCH_OBJ);
        }

        public function single(){
            $this->execute();
            return $this->statment->fetch(PDO::FETCH_OBJ);
        }

        public function rowCount(){
            return $this->statment->rowCount();
        }
    }