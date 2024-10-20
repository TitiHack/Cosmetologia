<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../public/css/styles-registro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Playwrite+CU:wght@100..400&display=swap"
        rel="stylesheet">

</head>

<body>
    <header>
        <h2>Registrarse</h2>
        <nav>
            <li><a href="../views/index.php">Inicio</a></li>
            <li><a href="../views/inicio-sesion.php">Iniciar sesion</a></li>
            <li><a href="../views/acercade.php">Acerca de</a></li>
          
        </nav>
    </header>

    <div class="container">
        <div class="mitad1">
            <img src="../public/images/logo2.jpeg" alt="">
        </div>
        
        <form action="" method="post" >
            <div class="contenido">
                <div class="contItems">
                    <?php
                    include("../crudcosmetologia/Conexion/conexion.php");
                    include("../controlador/controlador_registro.php");
                 
                    ?>
                    <div class="alineado">
                        <h3>Correo:</h3>
                        <input type="text" name="email">
                    </div>
                    <div class="alineado">
                        <h3>Documento:</h3>
                        <input type="text" name="documento">
                    </div>
                    <div class="alineado">
                        <h3>Celular:</h3>
                        <input type="text" name="celular">
                    </div>
                    
                    <div class="alineado">
                        <h3>Nombre:</h3>
                        <input type="text" name="nombre">
                    </div>
                    <div class="alineado">
                        <h3>Apellido:</h3>
                        <input type="text" name="apellido">
                    </div>                                       
                    <div class="alineado">
                        <h3>Contraseña:</h3>
                        <input type="text" name="contraseña">
                    </div>
                </div>
        
            <div class="chulito">     
                <h4>Crear cuenta como provedor</h4>
                <input type="checkbox" name="check" id="chulito">
            </div> 
    
            <input name="registrarB" type="submit">REGRISTRARSE</input>
        </form>    
        </div>

    </div>


</body>

</html>