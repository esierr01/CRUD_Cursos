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
        $regAeditar = $db->consultaUnUnicoRegPorId($conn, "matricula", $txtId);
        // carga dato del curso
        $curAeditar = $db->consultaUnUnicoRegPorId($conn, "cursos", $regAeditar['idCurso']);
        // carga dato del estudiante
        $estAeditar = $db->consultaUnUnicoRegPorId($conn, "estudia", $regAeditar['idEstudiante']);
    }
    if($_POST){
        $txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";        
        // elimino el registro actual
        $elimina = $db->eliminaUnRegistroPorId($conn, "matricula", $txtId);
        header("Location: index.php");
    }
?>

<div class="contieneDatos">

    <div class="nav">
        <ul class="me-auto p-0 m-0">
            <h2 class="text-center mt-5 mb-0 fw-bold">MATRICULA</h2>
        </ul>
        <span class="mt-5 fw-bold">ELIMINAR MATRICULA</span>
    </div>

    <hr>

    <form action="" method="post">
        <div class="mt-4 mb-3">
            <input type="hidden" value="<?= $regAeditar['id']; ?>" name="txtId" id="txtId"/>
        </div>
        <div class="mb-4 mt-4">
            <label for="txtNombreCurso" class="form-label">Curso</label>
            <input type="text" class="form-control" name="txtNombreCurso" value="<?= $curAeditar['nombreCurso']; ?>" disabled/>
        </div>
        <div class="mb-5 mt-2">
            <label for="txtNombreEstudiante" class="form-label">Estudiante</label>
            <input type="email" class="form-control" name="txtNombreEstudiante" value="<?= $estAeditar['nombreEstudiante']; ?>" disabled/>
        </div>
        <hr>
        <div class="container text-center mt-5">            
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-trash-can"></i> Eliminar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button"><i class="fa-solid fa-xmark"></i> Cancelar</a>
        </div>
    </form> 
    
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/foot.php'); ?>