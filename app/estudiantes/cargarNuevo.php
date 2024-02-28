<?php
    session_start();
    $_SESSION['ver']=false;
    //verifica si esta autorizado, si no lo esta debe hacer login, y lo manda a login
    if (!$_SESSION['accesoAutorizado']) {
        header("Location: /crud_cursos/app/login/index.php");
    }
    // valida si hubo POST
    if($_POST){
        // recibo nombre de nuevo estudiante
        $txtNombreEstudiante=(isset($_POST['txtNombreEstudiante']))?$_POST['txtNombreEstudiante']:"";
        $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
        if($txtNombreEstudiante & $txtCorreo){
            // conecto la bd
            require $_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/config/db.php';
            $db = new db();
            $conn = $db->conecta();
            // valido que el nuevo estudiante indicado no este cargado ya
            $valida=$db->validaUnicoReg($conn, "estudia", "nombreEstudiante", $txtNombreEstudiante);
            if($valida){
                // si esta cargado muestro mensaje de error
                include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/app/estudiantes/modalRegistroYaExiste.php');
                echo '<script>';
                $mostrarModal = true; 
                echo 'document.addEventListener(\'DOMContentLoaded\', function() {
                    var myModalEl = new bootstrap.Modal(document.getElementById(\'mymodal\'), { keyboard: false });
                    myModalEl.show();
                });';
                echo '</script>';
            }else{           
                // de lo contrario se carga el nuevo estudiante          
                $inserta=$db->insertaUnEstudiante($conn, $txtNombreEstudiante, $txtCorreo);
                header("Location: index.php");
            }           
        }
    }
    //
    include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/head.php');
    //
?>

<div class="contieneDatos">

    <div class="nav">
        <ul class="me-auto p-0 m-0">
            <h2 class="text-center mt-5 mb-0 fw-bold">ESTUDIANTES</h2>
        </ul>
        <span class="mt-5 fw-bold">AGREGAR NUEVO ESTUDIANTE</span>
    </div>

    <hr>

    <form action="" method="post">
        <div class="mt-4 mb-3">
            <input type="hidden" name="txtId" id="txtId"/>
        </div>
        <div class="mb-4 mt-4">
            <label for="txtNombreEstudiante" class="form-label">Nombre del Estudiante</label>
            <input type="text" class="form-control" name="txtNombreEstudiante" placeholder="Ingrese nombre del estudiante (255 carácteres)"/>
        </div>
        <div class="mb-5 mt-2">
            <label for="txtCorreo" class="form-label">Correo del Estudiante</label>
            <input type="email" class="form-control" name="txtCorreo" placeholder="Ingrese correo del estudiante (120 carácteres)"/>
        </div>
        <hr>
        <div class="container text-center mt-5">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Guardar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button"><i class="fa-solid fa-xmark"></i> Cancelar</a>
        </div>
    </form> 
    
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/foot.php'); ?>