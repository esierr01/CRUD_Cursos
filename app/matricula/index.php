<?php
    session_start();
    $_SESSION['ver']=true;
    //verifica si esta autorizado, si no lo esta debe hacer login, y lo manda a login
    if (!$_SESSION['accesoAutorizado']) {
        header("Location: /crud_cursos/app/login/index.php");
    }
    //
    include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/head.php');
    // se conecta a la bd
    require $_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/config/db.php';
    $db = new db();
    $conn = $db->conecta();
    // hace consulta de todos los cursos existentes y los coloca en variable para poder mostrarlos
    $listaCursos = $db->consultaMatricula($conn);
?>

<div class="contieneTablaMatricula">

    <div class="nav">
        <ul class="me-auto p-0 m-0">
            <h2 class="text-center mt-5 mb-0 fw-bold">MATRICULA</h2>
        </ul>
        <a name="" id="" class="btn btn-sm btn-success mt-5 fw-bold" href="cargarNuevo.php" role="button"><i class="fa-solid fa-plus"></i> NUEVA MATRICULA</a>
    </div>

    <hr>

    <table class="colorTable mt-2" id="myTable">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre del Curso</th>
                <th scope="col">Estudiante matriculado</th>
                <th scope="col">Fecha carga</th>
                <th class="text-center" scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaCursos as $reg) { ?>
                <tr>
                    <th scope="row"><?= $reg['id']; ?></th>
                    <td><?= $reg['nombreCurso']; ?></td>
                    <td><?= $reg['nombreEstudiante']; ?></td>
                    <td class="text-center"><?= $reg['fechaAlta']; ?></td>
                    <td class="text-center">
                        <form action="" method="post">
                            <a name="" id="" class="btn btn-primary" href="editarExistente.php?id=<?= $reg['id']; ?>" role="button"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                            <a name="" id="" class="btn btn-danger" href="eliminarExistente.php?id=<?= $reg['id']; ?>" role="button"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
                        </form>                        
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/foot.php'); ?>