<?php include '../templates/cabezera.php'; ?>
<?php include '../secciones/cursos.php'; ?>

<div class="container mt-4">
    <div class="row">
        <!-- Formulario (izquierda) -->
        <div class="col-md-5">
            <form action="" method="post">
                <div class="card">
                    <div class="card-header">Cursos</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="id" class="form-label">ID</label>
                            <input type="text" class="form-control" name="id" id="id" value="<?php echo $id;?>" placeholder="ID" />
                        </div>
                        <div class="mb-3">
                            <label for="nombre_curso" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre_curso" id="nombre_curso" value="<?php echo $nombre_curso;?>" placeholder="nombre del curso"/>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                            <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                            <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
                        </div>
                    </div> <!-- Aquí sí se cierra bien el card-body -->
                </div>
            </form>
        </div>

        <!-- Tabla (derecha) -->
        <div class="col-md-7">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($listaCursos as $curso) { ?>
                        <tr>
                            <td><?php echo $curso['id']; ?></td>
                            <td><?php echo $curso['nombre_curso']; ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?php echo $curso['id']; ?>" />
                                    <input type="submit" value="Seleccionar" name="accion" class="btn btn-info" />
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
