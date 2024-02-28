<?php
    session_start();
    $_SESSION['ver']=false;
    //verifica si esta autorizado, si no lo esta debe hacer login, y lo manda a login
    if (!$_SESSION['accesoAutorizado']) {
        header("Location: /crud_cursos/app/login/index.php");
    }
    // valida si hubo POST
    if($_POST){
        // recibo nombre de nuevo curso
        $txtNombreCurso=(isset($_POST['txtNombreCurso']))?$_POST['txtNombreCurso']:"";
        if($txtNombreCurso){
            // conecto la bd
            require $_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/config/db.php';
            $db = new db();
            $conn = $db->conecta();
            // valido que el nuevo curso indicado no este cargado ya
            $valida=$db->validaUnicoReg($conn, "cursos", "nombrecurso", $txtNombreCurso);
            if($valida){
                // si esta cargado muestro mensaje de error
                include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/app/cursos/modalRegistroYaExiste.php');
                echo '<script>';
                $mostrarModal = true; 
                echo 'document.addEventListener(\'DOMContentLoaded\', function() {
                    var myModalEl = new bootstrap.Modal(document.getElementById(\'mymodal\'), { keyboard: false });
                    myModalEl.show();
                });';
                echo '</script>';
            }else{           
                // de lo contrario se carga el nuevo curso          
                $inserta=$db->insertaUnCurso($conn, $txtNombreCurso);
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
            <h2 class="text-center mt-5 mb-0 fw-bold">CURSOS</h2>
        </ul>
        <span class="mt-5 fw-bold">AGREGAR NUEVO CURSO</span>
    </div>

    <hr>

    <form action="" method="post">
        <div class="mt-4 mb-3">
            <input type="hidden" name="txtId" id="txtId"/>
        </div>
        <div class="mb-5 mt-4">
            <label for="txtNombreCurso" class="form-label">Nombre del Curso</label>
            <input type="text" class="form-control" name="txtNombreCurso" placeholder="Ingrese nombre del curso (120 carácteres)"/>
        </div>
        <hr>
        <div class="container text-center mt-5">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Guardar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button"><i class="fa-solid fa-xmark"></i> Cancelar</a>
        </div>
    </form> 
    
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/foot.php'); ?>