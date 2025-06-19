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
//Vamos a asignar id mediante el formulario**************************************//
$id = isset($_POST['id']) ? $_POST['id'] :'';
$nombre_curso = isset($_POST['nombre_curso']) ? $_POST['nombre_curso'] : '';
print_r($_POST);
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
            $consulta = $conexionBD->prepare("INSERT INTO cursos (nombre_curso) VALUES (:nombre_curso)");
            $consulta->bindParam(':nombre_curso', $nombre_curso);
            $consulta->execute();
            break;

        case 'editar':
            $consulta = $conexionBD->prepare("UPDATE cursos SET nombre_curso = :nombre_curso WHERE id = :id");
            $consulta->bindParam(':nombre_curso', $nombre_curso);
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            break;

        case 'borrar':
            $consulta = $conexionBD->prepare("DELETE FROM cursos WHERE id = :id");
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            break;
        case 'Seleccionar':
            $consulta = $conexionBD->prepare('SELECT * FROM cursos WHERE id = :id');
            $consulta->bindParam(':id', $id);
            $consulta->execute();
            $cursoSeleccionado = $consulta->fetch(PDO::FETCH_ASSOC);
            print_r($curso);
            $nombre_curso=$cursoSeleccionado['nombre_curso'];
           // echo $nombre_curso;
            break;
        
    }
 }
//***********************************************************************************/

//Seleccion y consulta************************************************************//

//-*****************************************************************************-//
//----vamos a jalar los datos para que los botones funcionen correctamente
//print_r($_POST);

$consulta=$conexionBD->prepare("SELECT * FROM cursos");
$consulta->execute();
$listaCursos=$consulta->fetchAll();

//print_r($listaCursos);

//********************************************************************************//

//INSERT INTO `cursos` (`id`, `nombre_curso`) VALUES (NULL, 'Sitio web con PHP');
//INSERT INTO `alumnos` (`id`, `nombre`, `apellidos`) VALUES (NULL, 'Gemma', 'Palomino Salido');

/*
ALTER TABLE alumnos_cursos
ADD CONSTRAINT fk_alumno
FOREIGN KEY (id_alumno) REFERENCES alumnos(id)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

ALTER TABLE alumnos_cursos
ADD CONSTRAINT fk_curso
FOREIGN KEY (id_curso) REFERENCES cursos(id)
ON DELETE RESTRICT
ON UPDATE RESTRICT;

*/


?>