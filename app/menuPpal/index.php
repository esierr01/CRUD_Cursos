<?php
    session_start();
    //verifica si esta autorizado, si no lo esta debe hacer login, y lo manda a login
    if (!$_SESSION['accesoAutorizado']){
        header("Location: /crud_cursos/app/login/index.php");
    }    
    //
    include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/asset/layout/head.php');
?>


<div class="imagenCentral">
    <img src="/crud_cursos/asset/img/imagenCursos.png" alt="" width="1000px">
</div>


<?php include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/asset/layout/foot.php'); ?>

    