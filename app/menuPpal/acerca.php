<?php
    session_start();
    //verifica si esta autorizado, si no lo esta debe hacer login, y lo manda a login
    if (!$_SESSION['accesoAutorizado']){
        header("Location: /crud_cursos/app/login/index.php");
    }    
    //
    include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/asset/layout/head.php');
?>

<div class="acercade">

    <div class="text-center">
        <ul class="me-auto p-0 m-0">
            <h2 class="mt-5 mb-4 fw-bold">ACERCA DE ..</h2>
        </ul>
    </div>

    <hr>

    <p class="text-center mt-4">
        <strong>Página WEB Desarrollada por Emmanuel Sierra <br> emmanuel.sierra@gmail.com</strong> <br><br>

        Para el desarrollo se utilizaron los siguientes lenguajes y librerías: <br><br>
        - PHP, JAVASCRIPT <br>
        - HTML, CSS <br>
        - BOOSTRAP 5, DATATABLES, JQUERY, FONTAWESOME <br><br>

        En Caracas, Venezuela <br>
    </p>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/asset/layout/foot.php'); ?>
