<nav class="navbar navbar-expand-lg customNavBar">
    <div class="container-fluid">
        <img class="mt-3 mx-2 p-0" src="/crud_cursos/asset/img/birrete.png" alt="" width="50px">
        <span class="navbar-brand fs-4 fw-bold mb-1">CRUD Cursos</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <?php if ($_SESSION['accesoAutorizado']){  ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/crud_cursos/app/menuPpal/index.php">Home</a>
                    </li>                
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Matricula</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/crud_cursos/app/cursos/index.php">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Alumnos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/crud_cursos/index.php">Cerrar</a>
                    </li>
                    <?php if($_SESSION['nivel']==1) { ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Admin</a>
                        </li>                        
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Admin</a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
            <?php if ($_SESSION['accesoAutorizado']){  ?>                
                <small class="text-light">Usuario: <?= $_SESSION['usuarioAcceso']; ?></small>
            <?php } ?>
        </div>
    </div>
</nav>