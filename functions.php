<?php 

// conexion a la base de datos
function conexion($bd_config){
	try {
		$conexion = new PDO('mysql:host=localhost;dbname='.$bd_config['basedatos'], $bd_config['usuario'], $bd_config['pass']);
		return $conexion;
	} catch (PDOException $e) {
		return false;
	}
}

// funcion para limpiar los datos
function limpiarDatos($datos){
	// trim() evita los espacios en blanco al principio y al final del texto
	$datos = trim($datos);
	// stripcslashes() evita que se pueda interpretar los simbolos con barras como el salto de linea \n
	$datos = stripcslashes($datos);
	// htmlspecialchars() funcion que se utiliza para evitar la inyeccion de codigo por medio de tags html
	$datos = htmlspecialchars($datos);
	return $datos;
}

// funcion que sirve para definir la pagina actual en donde se encuentra el usuario por medio del valor de la variable global $_GET
function pagina_actual(){
	return isset($_GET['p']) ? (int)$_GET['p'] : 1;
}

// funcion que se utiliza para cargar los posts que se mostraran en la pagina principal dependiendo del numero de pagina actual y de la cantidad de post por pagina
function obtener_post($post_por_pagina, $conexion){
	$inicio = (pagina_actual() > 1) ? pagina_actual() * $post_por_pagina - $post_por_pagina : 0;
	$sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM articulos LIMIT $inicio, $post_por_pagina");
	$sentencia->execute();
	return $sentencia->fetchAll();
}

// funcion para definir el numero de paginas que se mostraran en la paginacion de la pagina
function numero_paginas($post_por_pagina, $conexion){
	$total_post = $conexion->prepare('SELECT FOUND_ROWS() as total');
	$total_post->execute();
	$total_post = $total_post->fetch()['total'];
	// ceil() sirve para redondear hacia arriba un numero
	$numero_paginas = ceil($total_post / $post_por_pagina);
	return $numero_paginas;
}

// funcion para encontrar el id del articulo 
function id_articulo($id){
	return (int)limpiarDatos($id);
}

// funcion para encontrar el articulo en la base de datos en base al id del articulo seleccionado en la pagina principal
function obtener_post_por_id($conexion, $id){
	$resultado = $conexion->query("SELECT * FROM articulos WHERE id = $id LIMIT 1");
	$resultado = $resultado->fetchAll();
	return ($resultado) ? $resultado : false;
}

// funcion que se utiliza para mostrar la fecha en un formato mas amigable al usuario
function fecha($fecha){
	$timestamp = strtotime($fecha);
	$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
	$dia = date('d', $timestamp);
	$mes = date('m', $timestamp) - 1;
	$year = date('Y', $timestamp);
	$fecha = "$dia de " . $meses[$mes] . " del $year";
	return $fecha;
}

function comprobarSession(){
	if (!isset($_SESSION['admin'])) {
		header('Location: ' . RUTA);
	}
}

?>