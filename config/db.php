<?php
    class db{
        private $host = 'localhost';
        private $dbname = 'dbf_crud_cursos';
        private $user = 'root';
        private $password = '';

        public function conecta(){
            try{
                $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->password);
                return $conn;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }
?>