<?php 

session_start();
session_destroy(); // Destruir la sesión para cerrar sesión
header('Location: ../index.php'); // Redirigir al inicio de sesión
exit(); // Asegurarse de que no se ejecute más código después de redir


?>
