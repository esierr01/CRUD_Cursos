<?php
    // valida conexión a la DB, crea objeto db con su metodo para conectarse a la BD
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

        public function validaUser($conn, $user, $password){
            $consultaSql=$conn->prepare("SELECT * FROM user WHERE user=:user and password=:password");
            $consultaSql->bindParam(':user',$user);
            $consultaSql->bindParam(':password',$password);
            $consultaSql->execute();
            $resultado = $consultaSql->fetch(PDO::FETCH_LAZY);
            return $resultado;
        }

        public function consultaTabla($conn, $tabla){
            $consultaSql=$conn->prepare("SELECT * FROM ".$tabla);
            $consultaSql->execute();
            $resultado = $consultaSql->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }
?>