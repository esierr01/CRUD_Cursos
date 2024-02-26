<?php include $_SERVER['DOCUMENT_ROOT'].'/crud_cursos/asset/layout/headSimple.php'; ?>

<?php
    if($_POST){
        $txtUser=(isset($_POST['txtUser']))?$_POST['txtUser']:"";
        $txtPassword=(isset($_POST['txtPassword']))?$_POST['txtPassword']:"";
        
        if($txtUser!='' and $txtPassword!=''){
            require $_SERVER['DOCUMENT_ROOT'].'/crud_cursos/mod/login/validaUser.php';
            $resulta = validaUser($txtUser, $txtPassword);
            if($resulta){
                echo 'usuario SI existe';
                $destino = $_SERVER['DOCUMENT_ROOT'].'/crud_cursos/mod/menuPpal/index.php';
                //echo $destino;
                header('Location: mod/menuPpal/index.php');
            }else{
                include($_SERVER['DOCUMENT_ROOT'].'/crud_cursos/mod/login/modalNoUsuario.php');
                echo '<script>';
                $mostrarModal = true; // Cambia esto según tus condiciones de búsqueda
                echo 'document.addEventListener(\'DOMContentLoaded\', function() {
                    var myModalEl = new bootstrap.Modal(document.getElementById(\'mymodal\'), { keyboard: false });
                    myModalEl.show();
                });';
                echo '</script>';
            }
        }
    }
?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/crud_cursos/asset/layout/login.php'; ?>


<?php include $_SERVER['DOCUMENT_ROOT'].'/crud_cursos/asset/layout/foot.php'; ?>