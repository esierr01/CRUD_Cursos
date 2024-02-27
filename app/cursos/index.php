<?php
session_start();
//verifica si esta autorizado, si no lo esta debe hacer login, y lo manda a login
if (!$_SESSION['accesoAutorizado']) {
    header("Location: /crud_cursos/app/login/index.php");
}
//
include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/head.php');
//
require $_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/config/db.php';
$db = new db();
$conn = $db->conecta();
$listaCursos = $db->consultaTabla($conn, "cursos");
?>



<div class="contieneTabla">

    <div class="nav">
        <ul class="me-auto p-0 m-0">
            <h2 class="text-center mt-5 mb-0 fw-bold">CURSOS</h2>
        </ul>
        <a name="" id="" class="btn btn-sm btn-success mt-5 fw-bold" href="#" role="button">NUEVO CURSO</a>
    </div>

    <hr>

    <table class="colorTable mt-2" id="myTable">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre del Curso</th>
                <th class="text-center" scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaCursos as $reg) { ?>
                <tr>
                    <th scope="row"><?= $reg['id']; ?></th>
                    <td><?= $reg['nombreCurso']; ?></td>
                    <td class="text-center">
                        <a name="" id="" class="btn btn-primary" href="#" role="button">Editar</a>
                        <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
</div>




<?php include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/foot.php'); ?>