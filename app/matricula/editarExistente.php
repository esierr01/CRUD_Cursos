<?php
    session_start();
    $_SESSION['ver']=false;
    //verifica si esta autorizado, si no lo esta debe hacer login, y lo manda a login
    if (!$_SESSION['accesoAutorizado']) {
        header("Location: /crud_cursos/app/login/index.php");
    }
    // conecto a la bd
    require $_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/config/db.php';
    $db = new db();
    $conn = $db->conecta();
    //
    include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/head.php');
    // recibo id del registro a editar, proveniente del get
    if($_GET){
        $txtId=(isset($_GET['id']))?$_GET['id']:"";
        // hago una consulta para cargar los datos del registro a una variable
        $regAeditar = $db->consultaUnUnicoRegPorId($conn, "matricula", $txtId);
        // carga dato del curso
        $lista_Cursos = $db->consultaTabla($conn, "cursos");
        // carga dato del estudiante
        $lista_Estudiantes = $db->consultaTabla($conn, "estudia");
    }
    if($_POST){
        $txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
        $txtIdCurso=(isset($_POST['txtNombreCurso']))?$_POST['txtNombreCurso']:"";
        $txtIdEstudiante=(isset($_POST['txtNombreEstudiante']))?$_POST['txtNombreEstudiante']:"";
        //
        if($txtIdCurso and $txtIdEstudiante){
            // valido si al guardar queremos guardar un nuevo registro que ya existe
            $validaUnicoReg = $db->validaUnicoRegXdosCampos($conn, "matricula", "idCurso", $txtIdCurso, "idEstudiante", $txtIdEstudiante);
            if($validaUnicoReg){
                if($validaUnicoReg['id']==$txtId){
                    $db->modificaUnaMatricula($conn, $txtId, $txtIdCurso, $txtIdEstudiante);
                    header("Location: index.php");
                }else{
                    // si no es el mismo, se muestra mensaje de error indicando que ya existe y no deja cargarlo
                    include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/app/estudiantes/modalRegistroYaExiste.php');
                    echo '<script>';
                    $mostrarModal = true; 
                    echo 'document.addEventListener(\'DOMContentLoaded\', function() {
                        var myModalEl = new bootstrap.Modal(document.getElementById(\'mymodal\'), { keyboard: false });
                        myModalEl.show();
                    });';
                    echo '</script>';
                }
            } else{
                // si no es igual, se deja modificar el registro
                $db->modificaUnaMatricula($conn, $txtId, $txtIdCurso, $txtIdEstudiante);
                header("Location: index.php");
            }
        }        
    }
?>

<div class="contieneDatos">

    <div class="nav">
        <ul class="me-auto p-0 m-0">
            <h2 class="text-center mt-5 mb-0 fw-bold">ESTUDIANTES</h2>
        </ul>
        <span class="mt-5 fw-bold">EDITAR ESTUDIANTE</span>
    </div>

    <hr>

    <form action="" method="post">
        <div class="mt-4 mb-3">
            <input type="text" value="<?= $regAeditar['id']; ?>" name="txtId" id="txtId"/>
        </div>
        <div class="mb-4 mt-4">
            <label for="txtNombreCurso" class="form-label">Curso</label>
            <select class="form-select form-select-lg" name="txtNombreCurso" id="txtNombreCurso">
                <?php foreach($lista_Cursos as $lcur) { ?>
                    <option <?php echo ($regAeditar['idCurso']==$lcur['id'])?"selected":""; ?> value="<?php echo $lcur['id'] ?>">
                        <?php echo $lcur['nombreCurso'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-4 mt-4">
            <label for="txtNombreEstudiante" class="form-label">Estudiante</label>
            <select class="form-select form-select-lg" name="txtNombreEstudiante" id="txtNombreEstudiante">
                <?php foreach($lista_Estudiantes as $lest) { ?>
                    <option <?php echo ($regAeditar['idEstudiante']==$lest['id'])?"selected":""; ?> value="<?php echo $lest['id'] ?>">
                        <?php echo $lest['nombreEstudiante'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <hr>
        <div class="container text-center mt-5">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Guardar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button"><i class="fa-solid fa-xmark"></i> Cancelar</a>
        </div>
    </form> 
    
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/foot.php'); ?>