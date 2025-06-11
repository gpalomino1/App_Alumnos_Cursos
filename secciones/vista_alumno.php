<?php include '../templates/cabezera.php'; ?>
<?php include '../secciones/alumnos.php'; ?>
<!-- Contenedor principal -->
<div class="container mt-4">
    <div class="row">
        <!-- Columna izquierda: Formulario -->
        <div class="col-md-5">
            <form action="" method="post">
                <div class="card">
                    <div class="card-header">Alumnos</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="id" class="form-label">ID</label>
                            <input type="text" class="form-control" name="id" id="id"
                                value="<?php echo $id;?>" placeholder=" ID" />
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre"
                                value="<?php echo $nombre;?>" placeholder="Nombre del Alumno" />
                        </div>

                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos"
                                value="<?php echo $apellidos; ?>" placeholder="Apellidos del Alumno" />
                        </div>

                        <div class="mb-3">
                            <label for="listaCursos" class="form-label">Cursos del alumno</label>
                            <select multiple class="form-control" name="cursos[]" id="listaCursos">
                                <option value="" disabled selected>Seleccione un curso</option>
                                <!-- Aquí se generan las opciones de cursos -->

                              
                                    <?php foreach ($cursos as $curso): ?>
                                        <option value="<?php echo $curso['id']; ?>"
                                            <?php 
                                                if (isset($alumnoSeleccionado['cursos']) && in_array($curso['id'], array_column($alumnoSeleccionado['cursos'], 'id'))) {
                                                    echo 'selected';
                                                }
                                            ?>>
                                            <?php echo $curso['nombre_curso']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                
                            </select>
                        </div>

                        <div class="btn-group" role="group" aria-label="Button group name">
                            <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
                            <button type="submit" name="accion" value="editar" class="btn btn-warning">Editar</button>
                            <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Columna derecha: Tabla -->
        <div class="col-md-7">
            <div class="table-responsive mt-2 mt-md-0">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $alumno): ?>
                        <tr>
                            <td><?php echo $alumno['id']; ?></td>
                            <td>
                                <?php echo $alumno['nombre'] . ' ' . $alumno['apellidos']; ?>
                                <br>

                                <?php foreach($alumno["cursos"]as $curso){ ?>
                                  <a href="#"> <?php echo $curso['nombre_curso'];?></a> <br/>


                                <?php };?>
                                
                            </td>
                           <td>
    <form method="post" style="display:inline;">
        <input type="hidden" name="id" value="<?php echo $alumno['id']; ?>">
        <button type="submit" name="accion" value="Seleccionar" class="btn btn-primary btn-sm">Seleccionar</button>
    </form>
</td>
                        </tr>
                        <?php endforeach; ?>
                                </tbody>

                </table>
            </div>
        </div>
    </div>
</div>


<link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>

<?php include '../templates/pie.php'; ?>


