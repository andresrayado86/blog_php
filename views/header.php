<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Wendy+One" rel="stylesheet">   
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
        <link rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilos.css">
        <title>Blog de practica</title>
    </head>
    <body>
    	<header>
    		<div class="contenedor">
    			<div class="logo izquierda">
    				<p><a href="<?php echo RUTA; ?>">Mi primer Blog</a></p>
    			</div>
    			<div class="derecha">
    				<form class="buscar" name="busqueda" action="<?php echo RUTA; ?>/buscar.php" method="get">
						<input type="text" name="busqueda" placeholder="Buscar">
						<button type="submit" class="icono fa fa-search"></button>
					</form>

    				<nav class="menu">
    					<ul>
    						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
    						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
    						<li><a href="#"><i class="fa fa-envelope"></i></a></li>
    					</ul>
    				</nav>
    			</div>
    		</div>
    	</header>