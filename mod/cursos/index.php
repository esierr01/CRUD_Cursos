<?php include $_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/head.php'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card col-4 mt-4 customCard">
            <div class="card-header text-center fs-4 fw-bold">
                <strong>Lista de Cursos</strong>
            </div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>                        
                    </tbody>
                </table>
            </div>

            <div class="card-footer text-muted text-center">
                <button type="submit" class="btn btn-info">Cargar Nuevo Curso</button>
            </div>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/crud_cursos/asset/layout/foot.php'; ?>