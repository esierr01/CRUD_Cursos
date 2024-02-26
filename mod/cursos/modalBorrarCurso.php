<form action="" method="post">
    <div class="modal fade" id="mymodal" tabindex="-1" aria-labelledby="modalBorrarCurso" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-info">

                <div class="modal-header">
                    <h5 class="modal-title text-light fw-bold" id="modalBorrarCurso">Borrar Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body fs-5 text-dark fw-bold">
                    <input type="hidden" name="txtId" value="<?= $txtId; ?>">
                    <div class="modal-body fs-5 text-center text-black fw-bold">¿ Desea borrar el curso seleccionado ?</div>
                    <div class="modal-body fs-6 text-center text-black fw-bold">Si borra un curso con estudiantes matriculados, borrara esta información tambien</div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="borrarDatos">Borrar</button>
                    <button type="submit" class="btn btn-warning" name="cerrarNoDatos">Cancelar</button>
                </div>

            </div>
        </div>
    </div>
</form>