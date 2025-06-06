<?php 

//********************************************************************************//
class BD {
public static function crearInstancia() {
$host = '127.0.0.1'; // Usamos IP para evitar error de socket
$dbname = 'aplicacion'; // Tu base de datos real
$username = 'gpalomino'; // Tu usuario
$password = '161718'; // Tu contraseña

try {
$conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "✅ ¡Conexión a la base de datos exitosa!";
return $conexion;
} catch (PDOException $e) {
die("❌ Error de conexión: " . $e->getMessage());
}
}
}

include_once '../configuraciones/bd.php';
$conexionBD=BD::crearInstancia();
//********************************************************************************/

//print_r($_POST);
//*************SE PONE LOS DATOS DE LOS ESTUDIANTES EN EL CUADRO DE LA DERECHA****/
$sql="SELECT * FROM alumnos";
$listaAlumnos=$conexionBD->query($sql);
$alumnos=$listaAlumnos->fetchAll();


//print_r($alumnos);
//Vamos a asignar id mediante el formulario**************************************//
$id = isset($_POST['id']) ? $_POST['id'] :'';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
print_r($_POST);
$nombre_curso = isset($_POST['nombre_curso']) ? $_POST['nombre_curso'] : '';
 $accion = isset($_POST['accion']) ? $_POST['accion'] : '';

 if ($accion != '') {   
    // Si la acción no está vacía, procedemos a realizar la consulta
    // Dependiendo de la acción, creamos, editamos o borramos un curso
    // Preparar la consulta según la acción
    // Usamos sentencias preparadas para evitar inyecciones SQL
    // y mejorar la seguridad de la aplicación
    // Las sentencias preparadas son una forma de ejecutar consultas SQL de manera segura   
    switch ($accion) {
        case 'agregar':
            // Preparar la consulta para insertar un nuevo curso
            $consulta = $conexionBD->prepare("INSERT INTO alumnos (nombre, apellidos) VALUES (:nombre, :apellidos)");
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':apellidos', $apellidos);
    $consulta->execute();
    // 🚫 Esto evita que se repita el envío al recargar la página
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
   


        case 'editar':
    $consulta = $conexionBD->prepare("UPDATE alumnos SET nombre = :nombre, apellidos = :apellidos WHERE id = :id");
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':apellidos', $apellidos);
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    break;

        case 'borrar':
            $consulta = $conexionBD->prepare("DELETE FROM alumnos WHERE id = :id");
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            break;

        case 'Seleccionar':
    $consulta = $conexionBD->prepare('SELECT * FROM alumnos WHERE id = :id');
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    $alumnoSeleccionado = $consulta->fetch(PDO::FETCH_ASSOC);
    
    if ($alumnoSeleccionado) {
        $nombre = $alumnoSeleccionado['nombre'];
        $apellidos = $alumnoSeleccionado['apellidos'];
    }
    break;
        
    }
 }
//-*****************************************************************************-//
//----Vamos a JALAR los datos para que los BOTONES DEL CARD DE LA IZQUIERDA *****//
//********SE MUESTREN CON LOS DATOS DEL ALUMNO SELECCIONADO**********************//
//print_r($_POST);

$consulta=$conexionBD->prepare("SELECT * FROM alumnos");
$consulta->execute();
$listaAlumnos=$consulta->fetchAll();




?>