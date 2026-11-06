<!DOCTYPE html> 
<html>
	<head>
	<meta charset="utf-8">
	<title>Login</title> 
	<link rel="stylesheet"  href="css/style.css" />  

	<script src="js/jquery-1.11.1.min.js"></script>



</head> 
<body>
	<div class="page">
        <header>
			<div id="fondoEncabezadoSinAut"></div>
	    </header>
		<section id="main">
			<form action="autenticar.php" method="post"/>
				<div id="loginForm">
				<p>
					<h2>Iniciar Sesión</h2>
				</p>
				<div class="editor-label">
					Nombre de Usuario:
				</div>
				<div class="editor-field">
					<input type="text" name="usuario" id="usuario" value=""/>									
				</div>
				<div class="editor-label">
					Contraseña:
				</div>
				<div class="editor-field">
					<input type="password" name="contrasena" id="contrasena" value=""/>
				</div>           
				<p>
					<input type="submit" value="Iniciar Sesión" class="button" />
				</p>
			</form>
		</diV>            
        </section>
        <footer>
        <b>Instituto de Neurodesarrollo, UNAM, 2015   </b>
        </footer>		
	</div>
</body>
</html>