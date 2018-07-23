<?php

require "../../../modelo/Usuarios.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Burguerlandia</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/fontawesome/css/all.css">
    <link rel="stylesheet" href="../../css/estilosgenerales.css">
    <link rel="stylesheet" href="../../css/registroUser.css">
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/registroUser.js"></script>
</head>
<body>
<header id="header_principal">
    <nav>
        <ul> 
            <li><a href="index.php">Inicio</a></li>
            <li><a href="">Clientes</a></li>
            <li><a href="">Productos</a></li>
            <li><a href="">Informacion</a></li>
            <li><a href="">Domicilios</a></li>
            <li><a href="#" id="abreLogin">Iniciar Sesión</a></li>
        </ul>
    </nav>
</header>
<!--VENTANA DE LOGUEO-->
<div id="ventanaModal"></div>

<section id="contentformregistrouser">
    <div class="control" id="divtitulo">
        <h3 id="tituloregistro">Registro de usuarios</h3>
    </div>
	<form id="formregistrouser">
        <div class="control">
            <div id="divcontroltipoid">
                <label for="enviaRegistro" style="display: none"><input type="text" name="enviaRegistro" value="enviaRegistro"></label>
                <label for="tipoid" class="labelcontrol">Tipo identificación:</label>
                <label for="tipoid">
                    <select name="tipoid" required>
                        <option value="">Seleccionar...</option>
                        <?php
                            $objUsuario=new Usuario();
                            $pdo=$objUsuario->getConecta();
                            $sql="SELECT * FROM tipo_identificacion";
                            $stmt=$pdo->prepare($sql);
                            $stmt->execute();
                            while ($fila=$stmt->fetch(PDO::FETCH_ASSOC)):
                        ?>
                        <option value="<?php echo $fila["Tipo_id"]; ?>"><?php echo $fila["Desc_TipoId"]; ?></option>
                        <?php endwhile;  ?>
                    </select>
                </label>
            </div>
        </div>
        <div class="control">
            <label for="identificacion" class="labelcontrol">Número de identificación:</label>
            <label for="iden"><input type="number" name="iden" class="text" required></label>
        </div>
        <div class="control">
            <label for="nombre" class="labelcontrol">Nombre:</label>
            <label for="nom"><input type="text" name="nombre" class="text" required></label>
        </div>
        <div class="control">
            <label for="apellido" class="labelcontrol">Apellido:</label>
            <label for="ape"><input type="text" name="apellido" class="text" required></label>
        </div>
        <div class="control">
            <label for="tel" class="labelcontrol">Teléfono:</label>
            <label for="tel"><input type="number" name="tel" class="text"></label>
        </div>
        <div class="control">
            <label for="cel" class="labelcontrol">Celular:</label>
            <label for="cel"><input type="number" name="cel" class="text" required></label>
        </div>
        <div class="control">
            <label for="direccion" class="labelcontrol">Dirección residencial:</label>
            <label for="direccion"><input type="text" name="dir" class="text" required></label>
        </div>
        <div class="control">
            <label for="email" class="labelcontrol">Correo electrónico:</label>
            <label for="email"><input type="email" name="email" class="text" required></label>
        </div>
        <div class="control">
            <label for="usu" class="labelcontrol">Usuario:</label>
            <label for="usu"><input type="text" name="usu" class="text"></label>
        </div>
        <div class="control">
            <label for="pass" class="labelcontrol">Contraseña:</label>
            <label for="pass"><input type="password" name="pass" class="text" required></label>
        </div>
        <div class="control">
            <label for="pass" class="labelcontrol">Vuelve a escribir la contraseña:</label>
            <label for="pass"><input type="password" name="passdos" class="text" required></label>
        </div>
        <div class="control">
            <button type="submit" id="btn_registro" class="boton"><span><i class="far fa-save"></i></span>Guardar</button>
        </div>
	</form>
</section>
</body>
</html>