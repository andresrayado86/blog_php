<?php 

require 'admin/config.php';
require 'functions.php';

$conexion = conexion($bd_config);

// valida si la conexion con la base de datos es correcta
if (!$conexion) {
	header('Location: error.php');
}

// valida el metodo por el que se envian los datos de la busqueda, si el metodo es GET y lo que se encuentra en busqueda no esta vacio limpia el dato enviado
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['busqueda'])) {
	$busqueda = limpiarDatos($_GET['busqueda']);
	// prepara la busqueda en la base de datos en base al dato enviado busca en titulo y en el texto
	$statement = $conexion->prepare('SELECT * FROM articulos where titulo LIKE :busqueda or texto LIKE :busqueda');
	$statement->execute(array(':busqueda' => "%$busqueda%"));
	$resultados = $statement->fetchAll();

	// valida si los resultados no estan vacios
	if (empty($resultados)) {
		$titulo = 'No se encontraron articulos con el resultado: ' . $busqueda;
	} else {
		$titulo = 'Resultado de la busqueda: ' . $busqueda;
	}
} else {
	header('Location: ' . RUTA . '/index.php');
}

require 'views/buscar.view.php';

?>