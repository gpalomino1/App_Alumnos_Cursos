<?php 

//********************************************************************************//
/*
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
*/
include_once '../configuraciones/bd.php';
$conexionBD=BD::crearInstancia();
//********************************************************************************/

//print_r($_POST);
//*************SE PONE LOS DATOS DE LOS ESTUDIANTES EN EL CUADRO DE LA DERECHA****/
$consulta=$conexionBD->prepare("SELECT * FROM alumnos");
$consulta->execute();
$alumnos=$consulta->fetchAll(); // <--- esta es la variable que vas a usar



//print_r($alumnos);
//Vamos a asignar id mediante el formulario**************************************//
$id = isset($_POST['id']) ? $_POST['id'] :'';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
//print_r($_POST);
$nombre_curso = isset($_POST['nombre_curso']) ? $_POST['nombre_curso'] : '';
 $accion = isset($_POST['accion']) ? $_POST['accion'] : '';

 if ($accion != '') {   
   
    switch ($accion) {
       case 'agregar':
    $consulta = $conexionBD->prepare("INSERT INTO alumnos (nombre, apellidos) VALUES (:nombre, :apellidos)");
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':apellidos', $apellidos);
    $consulta->execute();
// 🔍 Obtener el ID del alumno recién creado
    $id = $conexionBD->lastInsertId(); 

    // 🔄 Asignar cursos seleccionados
    if (isset($_POST['cursos']) && is_array($_POST['cursos'])) {
        $cursosSeleccionados = $_POST['cursos'];//////////////////////////////////////////
        foreach ($cursosSeleccionados as $cursoId) {
            $consultaCurso = $conexionBD->prepare("INSERT INTO alumnos_cursos (id_alumno, id_curso) VALUES (:id_alumno, :id_curso)");
            $consultaCurso->bindParam(':id_alumno', $id);
            $consultaCurso->bindParam(':id_curso', $cursoId);
            $consultaCurso->execute();
        }
    }

    // ✅ Redirección después de todo
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
    ;


        case 'editar':
    // Actualizar los datos del alumno
    $consulta = $conexionBD->prepare("UPDATE alumnos SET nombre = :nombre, apellidos = :apellidos WHERE id = :id");
    $consulta->bindParam(':nombre', $nombre);
    $consulta->bindParam(':apellidos', $apellidos);
    $consulta->bindParam(':id', $id);
    $consulta->execute();

    // ✅ Insertar cursos nuevos sin duplicar
    if (isset($_POST['cursos']) && is_array($_POST['cursos'])) {
        $cursosSeleccionados = $_POST['cursos'];

        foreach ($cursosSeleccionados as $cursoId) {
            // Verificar si ya existe la relación
            $consulta = $conexionBD->prepare("SELECT COUNT(*) FROM alumnos_cursos WHERE id_alumno = :id_alumno AND id_curso = :id_curso");
            $consulta->bindParam(':id_alumno', $id);
            $consulta->bindParam(':id_curso', $cursoId);
            $consulta->execute();

            $existe = $consulta->fetchColumn();

            // Insertar solo si no existe
            if ($existe == 0) {
                $consulta = $conexionBD->prepare("INSERT INTO alumnos_cursos (id_alumno, id_curso) VALUES (:id_alumno, :id_curso)");
                $consulta->bindParam(':id_alumno', $id);
                $consulta->bindParam(':id_curso', $cursoId);
                $consulta->execute();
            }
        }
    }
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


foreach ($alumnos as $clave => $alumno) {
    $sql = "SELECT * FROM cursos WHERE id IN (SELECT id_curso FROM alumnos_cursos WHERE id_alumno = :id_alumno)";

    $consultaCursos = $conexionBD->prepare($sql);
    $consultaCursos->bindParam(':id_alumno', $alumno['id']);
    $consultaCursos->execute();
    $cursosAlumno = $consultaCursos->fetchAll();

    // CORRECTO: modificar el array original por referencia
    $alumnos[$clave]['cursos'] = $cursosAlumno;
}

//print_r($alumnos);
$sql="SELECT * FROM cursos";
$consulta=$conexionBD->prepare($sql);
$consulta->execute();
$cursos=$consulta->fetchAll(); // <--- esta es la variable que vas a usar



//*********************************************************************************//

   
//**********************************************************************************//


?>