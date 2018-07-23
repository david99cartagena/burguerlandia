<?php
/**
 * Created by PhpStorm.
 * User: fhjua
 * Date: 24/06/2018
 * Time: 3:58 PM
 */

//include_once "../../modelo/Usuarios.php";
session_start();
$misession=$_SESSION["admin"];
if ($misession == null){
    header("Location:../../../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla Domicilios</title>
    <link rel="stylesheet" href="../../css/fontawesome/css/all.css">
    <link rel="stylesheet" href="../../css/estilosgenerales.css">
    <link rel="stylesheet" href="../../css/vistaDomicilios.css">
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/vistaDomicilios.js"></script>
</head>
<body>
<header id="header_principal">
    <nav>
        <ul>
            <li><label for="admin"><input type="text" class="text" value="<?php echo $_SESSION["admin"];  ?>" readonly></label></li>
            <li><a href="#" id="cierrasession">Cerrar Sesión<span><i class="fas fa-sign-out-alt"></i></span></a></li>
        </ul>
    </nav>
</header>
<h3 id="titulotbl">Tabla Domicilio</h3>
<section id="tblDomicilio"></section>
</body>
</html>