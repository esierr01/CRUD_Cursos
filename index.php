<?php
    //destruye cualquier sesion anterior
    session_start();
    $_SESSION = array();
    session_destroy();
    //variable de sesion para id del usuario que accesa
    session_start();
    $_SESSION['accesoAutorizado']=false;
    $_SESSION['usuarioAcceso']='';
    $_SESSION['nivel']=0;
    //valida conexión a la db
    require $_SERVER['DOCUMENT_ROOT'].'/crud_cursos/asset/config/db.php';
    //envía a modulo login
    header("Location: /crud_cursos/app/login/index.php");
?>