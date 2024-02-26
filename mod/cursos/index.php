<?php include $_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/head.php'; ?>

<?php
    require $_SERVER['DOCUMENT_ROOT'].'/crud_cursos/config/db.php';
    $cursos = new db();
    $conn = $cursos->conecta();
    // valida primer post de esta propia instancia
    if ($_POST){
        if (isset($_POST['edit'])){
            echo 'presiono editar '.$_POST['edit'];
        }

        if (isset($_POST['delete'])){
            $txtId=intval(($_POST['delete']));            
            include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/mod/cursos/modalBorrarCurso.php');
            echo '<script>';
            $mostrarModal = true; // Cambia esto según tus condiciones de búsqueda
            echo 'document.addEventListener(\'DOMContentLoaded\', function() {
                var myModalEl = new bootstrap.Modal(document.getElementById(\'mymodal\'), { keyboard: false });
                myModalEl.show();
            });';
            echo '</script>';
        }

        if (isset($_POST['new'])){
            include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/mod/cursos/modalCrearCurso.php');
            echo '<script>';
            $mostrarModal = true; // Cambia esto según tus condiciones de búsqueda
            echo 'document.addEventListener(\'DOMContentLoaded\', function() {
                var myModalEl = new bootstrap.Modal(document.getElementById(\'mymodal\'), { keyboard: false });
                myModalEl.show();
            });';
            echo '</script>';
        }
    }
    // valida segundo post proveniente de los modales
    if ($_POST){   
        if (isset($_POST['guardarDatos'])){
            echo 'ojo';
            $txtNombreCurso=(isset($_POST['txtNombreCurso']))?$_POST['txtNombreCurso']:"";
            if ($txtNombreCurso){
                $consultasql = $conn->prepare("INSERT INTO cursos (id, nombrecurso) VALUES (null, :txtNombreCurso);");
                $consultasql->bindParam(':txtNombreCurso', $txtNombreCurso);
                $consultasql->execute();
                //
                header('Location: index.php');

            } else{
                include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/mod/cursos/modalNoDatos.php');
                echo '<script>';
                $mostrarModal = true; // Cambia esto según tus condiciones de búsqueda
                echo 'document.addEventListener(\'DOMContentLoaded\', function() {
                    var myModalEl = new bootstrap.Modal(document.getElementById(\'mymodal\'), { keyboard: false });
                    myModalEl.show();
                });';
                echo '</script>';                
            }
        } 
        if (isset($_POST['borrarDatos'])){
            $txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
            $consultasql = $conn->prepare("DELETE FROM cursos WHERE id=:id;");
            $consultasql->bindParam(':id', $txtId);
            $consultasql->execute();
            //
            //header('Location: index.php'); 
        } 
    }
    // valida tercer post proveniente de modal 3er nivel
    if ($_POST){
        if (isset($_POST['cerrarNoDatos'])){
            //header('Location: index.php');
        }
    }
    //
    $consultasql = $conn->prepare("SELECT * FROM cursos");
    $consultasql->execute();
    $listaCursos = $consultasql->fetchAll(PDO::FETCH_ASSOC);
?>

<form action="" method="POST">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card col-6 mt-4 customTabla">
            <div class="card-header text-center fs-4 fw-bold">
                <strong>Lista de Cursos</strong>
            </div>

            <div class="card-body">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre del Curso</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaCursos as $reg){ ?>
                            <tr>
                                <th scope="row"><?= $reg['id']; ?></th>
                                <td><?= $reg['nombreCurso']; ?></td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-primary" name="edit" value="<?= $reg['id']; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                                    <button type="submit" class="btn btn-sm btn-danger" name="delete" value="<?= $reg['id']; ?>"><i class="fa-solid fa-trash"></i> Eliminar</button>
                                </td>
                            </tr>                        
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer text-muted text-center">
                <button type="submit" class="btn btn-info" name="new"><i class="fa-solid fa-square-plus"></i> Cargar Nuevo Curso</button>
            </div>
        </div>
    </div>
</div>
</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/foot.php'; ?>