<?php
    // valida conexión a la DB, crea objeto db con su metodo para conectarse a la BD
    class db{
        private $host = 'localhost';
        private $dbname = 'dbf_crud_cursos';
        private $user = 'root';
        private $password = '';

        // función para conectar a la BD
        public function conecta(){
            try{
                $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->password);
                return $conn;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        // funcion para validar datos de acceso (usuario y clave)
        public function validaUser($conn, $user, $password){
            $consultaSql=$conn->prepare("SELECT * FROM user WHERE user=:user and password=:password"); 
            $consultaSql->bindParam(':user',$user);
            $consultaSql->bindParam(':password',$password);
            $consultaSql->execute();
            $resultado = $consultaSql->fetch(PDO::FETCH_LAZY);
            return $resultado;
        }

        // funcion para consultar todos los registros de una tabla de la bd
        public function consultaTabla($conn, $tabla){
            $consultaSql=$conn->prepare("SELECT * FROM ".$tabla);
            $consultaSql->execute();
            $resultado = $consultaSql->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }

        // funcion para consultar todos los registros de la tabla matricula de la bd
        public function consultaMatricula($conn){
            $consultaSql=$conn->prepare("
                SELECT ma.id, cu.nombreCurso, es.nombreEstudiante, ma.fechaAlta
                FROM matricula ma 
                JOIN cursos cu ON ma.idCurso = cu.id
                JOIN estudia es ON ma.idEstudiante = es.id            
            ");
            $consultaSql->execute();
            $resultado = $consultaSql->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }

        // funcion para consultar un unico registro de una tabla de la bd por el id
        public function consultaUnUnicoRegPorId($conn, $tabla, $valor){
            $consultaSql=$conn->prepare("SELECT * FROM ".$tabla." WHERE id=:id");
            $consultaSql->bindParam(':id',$valor);
            $consultaSql->execute();
            $resultado = $consultaSql->fetch(PDO::FETCH_LAZY);
            return $resultado;
        }

        // funcion para verificar que un registro exista en una tabla por un campo indicado
        public function validaUnicoReg($conn, $tabla, $campo, $valor){
            $consultaSql=$conn->prepare("SELECT * FROM ".$tabla." WHERE ".$campo."=:campo");
            $consultaSql->bindParam(':campo',$valor);
            $consultaSql->execute();
            $resultado = $consultaSql->fetch(PDO::FETCH_LAZY);
            return $resultado;
        }

        // funcion para verificar que un registro exista en una tabla por dos campos indicados
        public function validaUnicoRegXdosCampos($conn, $tabla, $campo1, $valor1, $campo2, $valor2){
            $consultaSql=$conn->prepare("SELECT * FROM ".$tabla." WHERE ".$campo1."=:campo1 AND ".$campo2."=:campo2");
            $consultaSql->bindParam(':campo1',$valor1);
            $consultaSql->bindParam(':campo2',$valor2);
            $consultaSql->execute();
            $resultado = $consultaSql->fetch(PDO::FETCH_LAZY);
            return $resultado;
        }

        // funcion para eliminar un registro en una tabla de la bd por el id
        public function eliminaUnRegistroPorId($conn, $tabla, $id){
            $consultaSql=$conn->prepare("DELETE FROM ".$tabla." WHERE id=:id");
            $consultaSql->bindParam(':id', $id);
            $consultaSql->execute();
            return $resultado;
        }

        // funcion para insertar un curso nuevo
        public function insertaUnCurso($conn, $valor){
            $consultaSql=$conn->prepare("INSERT INTO cursos (id, nombreCurso) VALUES (null, :txtNombreCurso);");
            $consultaSql->bindParam(':txtNombreCurso',$valor);
            $consultaSql->execute();
            return;
        }

        // funcion para insertar un estudiante nuevo
        public function insertaUnEstudiante($conn, $valor1, $valor2){
            $consultaSql=$conn->prepare("INSERT INTO estudia (id, nombreEstudiante, correo) VALUES (null, :txtNombreEstudiante, :txtCorreo);");
            $consultaSql->bindParam(':txtNombreEstudiante',$valor1);
            $consultaSql->bindParam(':txtCorreo',$valor2);
            $consultaSql->execute();
            return;
        }

        // funcion para insertar una matricula nueva
        public function insertaUnaMatricula($conn, $valor1, $valor2){
            $consultaSql=$conn->prepare("INSERT INTO matricula (id, idCurso, idEstudiante, fechaAlta) VALUES (null, :txtIdCurso, :txtIdEstudiante, current_timestamp());");
            $consultaSql->bindParam(':txtIdCurso',$valor1);
            $consultaSql->bindParam(':txtIdEstudiante',$valor2);
            $consultaSql->execute();
            return;
        }

        // funcion para modificar un curso existente
        public function modificaUnCurso($conn, $id, $valor){
            $consultaSql=$conn->prepare("UPDATE cursos SET nombreCurso = :txtNombreCurso WHERE id=:id;");
            $consultaSql->bindParam(':txtNombreCurso',$valor);
            $consultaSql->bindParam(':id',$id);
            $consultaSql->execute();
            return;
        }

        // funcion para modificar un curso existente
        public function modificaUnEstudiante($conn, $id, $valor1, $valor2){
            $consultaSql=$conn->prepare("UPDATE estudia SET nombreEstudiante = :txtNombreEstudiante, correo = :txtCorreo WHERE id=:id;");
            $consultaSql->bindParam(':txtNombreEstudiante',$valor1);
            $consultaSql->bindParam(':txtCorreo',$valor2);
            $consultaSql->bindParam(':id',$id);
            $consultaSql->execute();
            return;
        }

        // funcion para modificar una matricula existente
        public function modificaUnaMatricula($conn, $id, $txtIdCurso, $txtIdEstudiante){
            $consultaSql=$conn->prepare("UPDATE matricula SET idcurso=:txtIdCurso, idEstudiante=:txtIdEstudiante, fechaAlta=current_timestamp() WHERE id=:id;");
            $consultaSql->bindParam(':txtIdCurso',$txtIdCurso);
            $consultaSql->bindParam(':txtIdEstudiante',$txtIdEstudiante);
            $consultaSql->bindParam(':id',$id);
            $consultaSql->execute();
            return;
        }

    }
?>