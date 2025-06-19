<!-- esta aplicacion funciona con lampp y se tiene q activar-->
<!-- http://localhost:82/app/secciones/vista_cursos.php
 http://localhost:82/phpmyadmin/---utiliza el mysql del sistema con puerto 82 personaizado, no el phpmyadmin q trae xampp
-Por tanto hemos modificado lo siguiente: 
--------------------------------------------------------------------------------------
sudo nano /opt/lampp/phpmyadmin/config.inc.php

$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['user'] = 'admin';
$cfg['Servers'][$i]['password'] = 'MiClaveSegura123';
$cfg['Servers'][$i]['host'] = '127.0.0.1';
$cfg['Servers'][$i]['port'] = '3306';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['AllowNoPassword'] = false;

sudo /opt/lampp/lampp restartapache
---------------------------------------------------------------------------------------
para los iconos en bootrap icons:
https://icons.getbootstrap.com/



-->