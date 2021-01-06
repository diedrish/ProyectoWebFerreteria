
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="../images/wave.png">
	<div class="container">
		<div class="img">
			
		</div>
		<div class="login-content">
			<form name="formlogin" method="POST"  action="../controller/Usuarios/validar.php" class="formlogin">
			<img src="../images/avatar.svg">
				<h2 class="title">Bienvenido</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   	
           		   		<input type="text" id="usuario"  name="usuario" placeholder="Digite su Usuario" class="input" autocomplete="=off">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	
           		    	<input type="password" id="clave" name="clave" placeholder="Digite su Clave" class="input" autocomplete="off">
            	   </div>
            	</div>	
           		    <a href="Clientes/Clientes.php">Registrarse</a>
            
            
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
	</div>
	
</body>
</html>
