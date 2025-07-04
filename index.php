
<?php 
session_start(); // Iniciar sesión para manejar la autenticación    
if($_POST) {
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Aquí deberías validar el usuario y la contraseña con tu base de datos
    // Por simplicidad, vamos a usar un usuario y contraseña fijos
    if ($user === 'admin' && $password === '1234') {
        $_SESSION['user'] = $user; // Guardar el usuario en la sesión
        header('Location: secciones/index.php'); // Redirigir al index
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}


?>
<!doctype html>
<html lang="en">
    <head>
        <title>Inicio</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <div class="container">
<div class="row justify-content-center">
    <div class="col-md-4">
        <br><!--hace un lijero espacio el br -->
        <form action="" method="post">
            <div class="card">
                <div class="card-header">Inicio de sesión</div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="user" class="form-label">Usuario</label>
                        <input
                            type="text"
                            class="form-control"
                            name="user"
                            id="user"
                            aria-describedby="helpId"
                            placeholder="usuario"
                        />
                        <small id="helpId" class="form-text text-muted">Escriba su usuario</small>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input
                            type="password"
                            class="form-control"
                            name="password"
                            id="password"
                            aria-describedby="helpId"
                            placeholder="password"
                        />
                        <small id="helpId" class="form-text text-muted">Escriba su contraseña</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </div>
            </div>
        </form>
    </div>
</div>





        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

