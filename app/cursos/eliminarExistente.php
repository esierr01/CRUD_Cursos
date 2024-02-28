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
        $regAeditar = $db->consultaUnUnicoRegPorId($conn, "cursos", $txtId);
    }
    if($_POST){
        $txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
        $txtNombreCurso=(isset($_POST['txtNombreCurso']))?$_POST['txtNombreCurso']:"";
        // elimino el registro actual
        $elimina = $db->eliminaUnRegistroPorId($conn, "cursos", $txtId);
        header("Location: index.php");
    }
?>

<div class="contieneDatos">

    <div class="nav">
        <ul class="me-auto p-0 m-0">
            <h2 class="text-center mt-5 mb-0 fw-bold">CURSOS</h2>
        </ul>
        <span class="mt-5 fw-bold">ELIMINAR CURSO</span>
    </div>

    <hr>

    <form action="" method="post">
        <div class="mt-4 mb-3">
            <input type="hidden" value="<?= $regAeditar['id']; ?>" name="txtId" id="txtId"/>
        </div>
        <div class="mb-5 mt-4">
            <label for="txtNombreCurso" class="form-label">Nombre del Curso</label>
            <input type="text" class="form-control" value="<?= $regAeditar['nombreCurso']; ?>" name="txtNombreCurso" placeholder="Ingrese nombre del curso (120 carácteres)" disabled/>
        </div>
        <hr>
        <div class="container text-center mt-5">
            <div class="mb-3">
                <small class="text-danger fw-bold">(Al eliminar un curso, eliminara cualquier matricula asociada a el)</small>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-trash-can"></i> Eliminar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button"><i class="fa-solid fa-xmark"></i> Cancelar</a>
        </div>
    </form> 
    
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/foot.php'); ?>