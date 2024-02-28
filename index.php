<?php
    //destruye cualquier sesion anterior
    session_start();
    $_SESSION = array();
    session_destroy();
    //variable de sesion para identificación del usuario que accesa
    session_start();
    $_SESSION['accesoAutorizado']=false;
    $_SESSION['usuarioAcceso']='';
    $_SESSION['nivel']=0;
    $_SESSION['ver']=true; // valida que se ve la barra de menu, para caso de ediciones, agregar o eliminar
    //envía al modulo login
    header("Location: /crud_cursos/app/login/index.php");
?>