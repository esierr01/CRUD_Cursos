<form action="" method="post">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card col-4 mt-4 customCard">
                <div class="card-header text-center fs-4 fw-bold">
                    <strong>Acceso al Sistema</strong>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label for="txtUser" class="form-label"><i class="fa-regular fa-user"></i> Usuario:</label>
                        <input type="text" class="form-control" name="txtUser" placeholder="Ingrese un usuario (12 carácteres)" />
                    </div>
                    <div class="mb-3">
                        <label for="txtPassword" class="form-label"><i class="fa-solid fa-lock"></i> Clave:</label>
                        <input type="text" class="form-control" name="txtPassword" placeholder="Ingrese clave de acceso (20 carácteres)" />
                    </div>
                </div>

                <div class="card-footer text-muted text-center">
                    <button type="submit" class="btn btn-info">Ingresar</button>
                </div>
            </div>
        </div>
    </div>    
</form>