<?php
	session_start();
	$conexion = mysqli_connect("localhost", "root", "", "bd_empresa");
	$accentos = mysqli_query($conexion, "SET NAMES 'utf8'");
	
	
	//miramos si la conexión se ha realizado correctamente
	//si no es correcta, mostrar error
	if(!$conexion){
	    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	//si es correcta, seguimos trabajando
	} else {
		$usuario=$_REQUEST['usuario'];
		$password=$_REQUEST['password'];

		$q = "SELECT idUsuario,nombreUsuario FROM tbl_usuario WHERE nombreUsuario='$usuario' AND passwordUsuario='$password'";
		
		$dadesUsuaris = mysqli_query($conexion, $q);
		
		
		if(mysqli_num_rows($dadesUsuaris)>0){
			$reserva = mysqli_fetch_array($dadesUsuaris);
			$_SESSION['usuario'] = $reserva[nombreUsuario];
			$_SESSION['idUsuario'] = $reserva[idUsuario];

			echo "Bienvenido $_SESSION[usuario] con id $_SESSION[idUsuario]";

			if (($reserva['nombreUsuario'] =='admin') AND ($reserva['password'] =='admin')) {
				header('location: incidencias.php');			

			}
				header('location: principal.php');			
		}else{

			// header('location: index.html');	
			echo "El usuario o la contraseña son incorrectos";

			
		}		
	}
	echo "<br><br>";
	echo "<a href='index.html'>LOGIN</a>";

?>