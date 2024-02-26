<form action="" method="post">
    <div class="modal fade" id="mymodal" tabindex="-1" aria-labelledby="modalCrearCurso" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-info">

                <div class="modal-header">
                    <h5 class="modal-title text-light fw-bold" id="modalCrearCurso">Cargar Nuevo Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body fs-5 text-dark fw-bold">
                    <input type="hidden" name="txtId" />
                    <div class="mb-3">
                        <label for="txtNombreCurso" class="form-label">Nombre del Curso:</label>
                        <input type="text" class="form-control" name="txtNombreCurso" placeholder="Ingrese Nombre del Curso (120 carácteres)" />
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="guardarDatos">Guardar Datos</button>
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>
                </div>
            
            </div>
        </div>
    </div>
</form>