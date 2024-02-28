<?php
    session_start();
    $_SESSION['ver']=false;
    //verifica si esta autorizado, si no lo esta debe hacer login, y lo manda a login
    if (!$_SESSION['accesoAutorizado']) {
        header("Location: /crud_cursos/app/login/index.php");
    }
    //
    include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/head.php');
    // recibo id del registro a eliminar, proveniente del get
    if($_GET){
        $txtId=(isset($_GET['id']))?$_GET['id']:"";
        require $_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/config/db.php';
        $db = new db();
        $conn = $db->conecta();
        // hago una consulta para cargar los datos del registro a una variable
        $regAeditar = $db->consultaUnUnicoRegPorId($conn, "estudia", $txtId);
    }
    if($_POST){
        $txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
        $txtNombreEstudiante=(isset($_POST['txtNombreEstudiante']))?$_POST['txtNombreEstudiante']:"";
        $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
        // elimino el registro actual
        $elimina = $db->eliminaUnRegistroPorId($conn, "estudia", $txtId);
        header("Location: index.php");
    }
?>

<div class="contieneDatos">

    <div class="nav">
        <ul class="me-auto p-0 m-0">
            <h2 class="text-center mt-5 mb-0 fw-bold">ESTUDIANTES</h2>
        </ul>
        <span class="mt-5 fw-bold">ELIMINAR ESTUDIANTE</span>
    </div>

    <hr>

    <form action="" method="post">
        <div class="mt-4 mb-3">
            <input type="hidden" value="<?= $regAeditar['id']; ?>" name="txtId" id="txtId"/>
        </div>
        <div class="mb-4 mt-4">
            <label for="txtNombreEstudiante" class="form-label">Nombre del Estudiante</label>
            <input type="text" class="form-control" name="txtNombreEstudiante" value="<?= $regAeditar['nombreEstudiante']; ?>" placeholder="Ingrese nombre del estudiante (255 carácteres)"/>
        </div>
        <div class="mb-5 mt-2">
            <label for="txtCorreo" class="form-label">Correo del Estudiante</label>
            <input type="email" class="form-control" name="txtCorreo" value="<?= $regAeditar['correo']; ?>" placeholder="Ingrese correo del estudiante (120 carácteres)"/>
        </div>
        <hr>
        <div class="container text-center mt-5">
            <div class="mb-3">
                <small class="text-danger fw-bold">(Al eliminar un estudiante, eliminara cualquier matricula asociada a el)</small>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-trash-can"></i> Eliminar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button"><i class="fa-solid fa-xmark"></i> Cancelar</a>
        </div>
    </form> 
    
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/foot.php'); ?>