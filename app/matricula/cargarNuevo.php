<?php
session_start();
$_SESSION['ver'] = false;
//verifica si esta autorizado, si no lo esta debe hacer login, y lo manda a login
if (!$_SESSION['accesoAutorizado']) {
    header("Location: /crud_cursos/app/login/index.php");
}
// conecto a la bd
require $_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/config/db.php';
$db = new db();
$conn = $db->conecta();
// valida si hubo POST
if ($_POST) {    
    // recibo datos de nueva matricula
    $txtIdCurso = (isset($_POST['txtNombreCurso'])) ? $_POST['txtNombreCurso'] : "";
    $txtIdEstudiante = (isset($_POST['txtNombreEstudiante'])) ? $_POST['txtNombreEstudiante'] : "";
    if ($txtIdCurso & $txtIdEstudiante) {
        echo "por aqui voyyy";
        // valido que la nueva matricula no este cargada ya
        $valida = $db->validaUnicoRegXdosCampos($conn, "matricula", "idCurso", $txtIdCurso, "idEstudiante", $txtIdEstudiante);
        if ($valida) {
            // si esta cargado muestro mensaje de error
            include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/app/matricula/modalRegistroYaExiste.php');
            echo '<script>';
            $mostrarModal = true;
            echo 'document.addEventListener(\'DOMContentLoaded\', function() {
                    var myModalEl = new bootstrap.Modal(document.getElementById(\'mymodal\'), { keyboard: false });
                    myModalEl.show();
                });';
            echo '</script>';
        } else {
            // de lo contrario se carga el nuevo estudiante          
            $inserta = $db->insertaUnaMatricula($conn, $txtIdCurso, $txtIdEstudiante);
            header("Location: index.php");
        }
    }
}
//
include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/head.php');
// cargo lista de cursos
$lista_Cursos = $db->consultaTabla($conn, "cursos");
// cargo lista de estudiantes
$lista_Estudiantes = $db->consultaTabla($conn, "estudia");
?>

<div class="contieneDatos">

    <div class="nav">
        <ul class="me-auto p-0 m-0">
            <h2 class="text-center mt-5 mb-0 fw-bold">MATRICULA</h2>
        </ul>
        <span class="mt-5 fw-bold">AGREGAR NUEVA MATRICULA</span>
    </div>

    <hr>

    <form action="" method="post">
        <div class="mt-4 mb-3">
            <input type="hidden" name="txtId" id="txtId" />
        </div>
        <div class="mb-4 mt-4">
            <label for="txtNombreCurso" class="form-label">Curso</label>
            <select class="form-select form-select-lg" name="txtNombreCurso" id="txtNombreCurso">
                <?php foreach ($lista_Cursos as $lcur) { ?>
                    <option value="<?php echo $lcur['id'] ?>"><?php echo $lcur['nombreCurso'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-4 mt-4">
            <label for="txtNombreEstudiante" class="form-label">Estudiante</label>
            <select class="form-select form-select-lg" name="txtNombreEstudiante" id="txtNombreEstudiante">
                <?php foreach ($lista_Estudiantes as $lest) { ?>
                    <option value="<?php echo $lest['id'] ?>"><?php echo $lest['nombreEstudiante'] ?></option>
                <?php } ?>
            </select>
        </div>
        <hr>
        <div class="container text-center mt-5">
            <div class="mb-3">
                <small class="text-danger fw-bold">(Al matricular un curso este se cargará con la fecha del día de hoy)</small>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Guardar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button"><i class="fa-solid fa-xmark"></i> Cancelar</a>
        </div>
    </form>

</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/foot.php'); ?>