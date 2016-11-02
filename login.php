<?php session_start();

require 'admin/config.php';
require 'functions.php';

// valida el metodo por el que se envian los valores de usuario y contraseña si el metodo es POST asigna los valores a las variables $usuario y $password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usuario = limpiarDatos($_POST['usuario']);
	$password = limpiarDatos($_POST['password']);

	// Compara los valores que se enviaron desde el formulario con los que se guardaron el el archivo config.php
	if ($usuario == $blog_admin['usuario'] && $password == $blog_admin['pass']) {
		$_SESSION['admin'] = $blog_admin['usuario'];
		header('Location:' . RUTA . '/admin');
	}
}

require 'views/login.view.php';

?>