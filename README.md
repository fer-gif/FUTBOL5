# Trabajo especial de Web 2
# Grupo 6

 <b>Integrantes:<br>
 <ul>
   <li>Andersen, Lucas</li>
   <li>Hernando, Fermin</li>
 </ul></b>

<p>Permisos de acceso al sistema<br>
Administrador<br>
Usuario: Admin<br>
Password: Admin1234<br>
Capitán<br>
Usuario: capiRacing<br>
Password: racing1234</p>


El grupo escogió para resolver la problemática planteada por la cátedra de Web 2 un sitio web de gestión y visualización de un torneo de fútbol 5, el cual fue titulado como “Torneo de fútbol 5 Segundo Francia”.<br>

El sitio fue diagramado para 3 tipos de usuarios. Los usuarios que no se encuentran registrados en el sistema y no están logueado, tienen las siguientes funcionalidades:<br>
Ver la tabla de posiciones del torneo que se muestra en la pantalla <b>“Home”</b>.<br>
Ver los equipos inscriptos en el torneo que se encuentran en la sección <b>“Equipos”</b> . Si el usuario desea ver los jugadores que posee cada equipo puede hacer click en el equipo que desea y se le mostrará la lista de jugadores anotados en dicho equipo.<br>
Ver todos los jugadores anotados en el torneo en la sección <b>“Jugadores”</b>.<br>
Ver en la sección <b>“fixture”</b> los partidos con sus respectivos resultados que se hayan registrado.<br>
Cada equipo tendrá la posibilidad de tener una cuenta Capitan que le será entregada a un integrante de dicho equipo. Solo puede haber una cuenta Capitan por equipo y por medio de esta, además de las funcionalidades de las que disponen los usuarios sin loguearse podrán disponer de la sección <b>“Mi Equipo”</b>. Esta sección se cargará automáticamente con los datos del equipo al que pertenece la cuenta y en ella cada capitán podrá:<br>
Agregar nuevos jugadores que quedarán asociados al equipo en cuestión. <br>
Editar el escudo del equipo.<br>
La cuenta de administrador no tiene disponible la sección de <b>“Mi Equipo”</b> ya que es propia de la cuenta Capitan. Las funciones disponibles, además de las de los usuarios sin logueo son:<br>
Editar los datos de un equipo o eliminarlo del sistema en la sección <b>“Equipos”</b>. Si se clickea en el nombre de un equipo se despliega una lista de los jugadores que posee dicho equipo, los cuales también podrán ser editados o eliminados del sistema.<br>
Editar o eliminar del sistema un jugador de la sección <b>“Jugadores”</b>, la cual muestra todos los jugadores que se encuentran inscriptos en el torneo.<br>
Editar los datos de un partido (solo los goles y la fecha) disponible en la sección <b>“Fixture”</b>. También podrá eliminar un partido de esta sección.<br>
En la sección <b>“Gestión”</b>, el administrador tendrá las siguientes funcionalidades:<br>
Agregar un nuevo equipo al torneo.<br>
Agregar un nuevo jugador, completando los datos requeridos y seleccionando un equipo al que pertenece.<br>
Registrar un nuevo usuario con un permiso de acceso. Para esto, si la cuenta es de tipo Capitán deberá seleccionar el equipo al que pertenece dicha cuenta.<br>
Editar los datos de un usuario (solo nombre de usuario y email) y eliminar una cuenta deseada.<br>
Registrar el resultado de un partido.<br><br>


<b>Aclaraciones de funcionamientos</b><br><br>

Al registrar un nuevo partido se asumió que 2 equipos solo pueden enfrentarse una vez. Con lo cual si el par de equipos ya figura con un partido persistido en la base de datos devolverá un mensaje informando de que dichos equipos ya jugaron entre ellos.<br>
Un equipo solo podrá tener una cuenta capitan.<br>
Al eliminar un equipo del sistema también se eliminan los jugadores registrados en dicho equipo y la cuenta Capitan que pudiese tener asociada.<br>
Los escudos subidos por un equipo quedan alojados en una carpeta con el nombre del equipo dentro de la carpeta escudos que se encuentra en image (image/escudos/nombredelequipo). Si un equipo ya tiene un escudo y lo quiere actualizar, dicha carpeta eliminará el escudo viejo y guardará el escudo nuevo. Si el equipo es eliminado del torneo, la carpeta del escudo perteneciente a dicho equipo también es eliminada.<br>
