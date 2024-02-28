<?php
    session_start();
    //verifica si esta autorizado, si no lo esta debe hacer login, en caso de que si lo enviamos al index de principal
    if ($_SESSION['accesoAutorizado']){
        header("Location: /crud_cursos/app/menuPpal/index.php");
    }
    //verifica si hubo post, con los datos de acceso ingresados
    if($_POST){
        $txtUser=(isset($_POST['txtUser']))?$_POST['txtUser']:"";
        $txtPassword=(isset($_POST['txtPassword']))?$_POST['txtPassword']:"";
        // si los dos datos estan cargados hace verificación, de lo contrario no hace nada
        if($txtUser!='' and $txtPassword!=''){
            require $_SERVER['DOCUMENT_ROOT'].'/crud_cursos/asset/config/db.php';
            $db=new db();
            $conn=$db->conecta();
            $validaUser=$db->validaUser($conn, $txtUser, $txtPassword);
            //
            if($validaUser){
                // como encontro usuario, inicializa datos de acceso
                $_SESSION['accesoAutorizado']=true;
                $_SESSION['usuarioAcceso']=$validaUser['nombre'];
                $_SESSION['nivel']=$validaUser['acceso'];
                // envia al menu principal
                header("Location: /crud_cursos/app/menuPpal/index.php");
            } else{                
                // muestra mensaje de usuario no existe
                include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/app/login/modalUsuarioNoExiste.php');
                echo '<script>';
                $mostrarModal = true; 
                echo 'document.addEventListener(\'DOMContentLoaded\', function() {
                    var myModalEl = new bootstrap.Modal(document.getElementById(\'mymodal\'), { keyboard: false });
                    myModalEl.show();
                });';
                echo '</script>';
            }
        }
    }
    //
    include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/asset/layout/head.php');
?>

<form action="" method="post">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card col-4 mt-5 customCard">
                <div class="card-header text-center fs-4 fw-bold">
                    <strong>Acceso al Sistema</strong>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label for="txtUser" class="form-label"><i class="fa-regular fa-user"></i> Usuario:</label>
                        <input type="text" class="form-control" name="txtUser" placeholder="Ingrese un usuario (12 carácteres)"/>
                    </div>
                    <div class="mb-3">
                        <label for="txtPassword" class="form-label"><i class="fa-solid fa-lock"></i> Clave:</label>
                        <input type="text" class="form-control" name="txtPassword" placeholder="Ingrese clave de acceso (20 carácteres)"/>
                    </div>
                </div>

                <div class="card-footer text-muted text-center">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
            </div>
        </div>
    </div>    
</form>  

<?php include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/asset/layout/foot.php'); ?>

    