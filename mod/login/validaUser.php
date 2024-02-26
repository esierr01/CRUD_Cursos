<?php
    function validaUser($user, $password){
        require $_SERVER['DOCUMENT_ROOT'].'/crud_cursos/config/db.php';
        $valuser = new db();
        $conn = $valuser->conecta();

        $consultasql = $conn->prepare("SELECT * FROM user WHERE user=:user and password=:password");
        $consultasql->bindParam(':user',$user);
        $consultasql->bindParam(':password',$password);
        $consultasql->execute();
        $resultado = $consultasql->fetch(PDO::FETCH_LAZY);
        return $resultado;
    }
?>