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
    <title>Tabla Productos</title>
    <link rel="stylesheet" href="../../css/fontawesome/css/all.css">
    <link rel="stylesheet" href="../../css/estilosgenerales.css">
    <link rel="stylesheet" href="../../css/vistaProductos.css">
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/vistaProductos.js"></script>
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
<div id="ventanaModal">
    <div class="error" id="erroruno"><p>Solo se permiten los formatos png, jpeg, gif y jpg.</p></div>
    <div class="error" id="errordos"><p>El tamaño de la imagen debe de ser menor a 3 megabytes.</p></div>
    <div class="error" id="errortres"><p>Error al actualizar la imagen.</p></div>
    <div id="subeimagen">
        <a href="#" id="cierraModal"><strong>X</strong></a>
        <div id="contentformnewimg">
            <h3 id="titulonewimg">Escoge una imagen:</h3>
            <form id="formnewimg" enctype="multipart/form-data">
                <table id="tblnewimg">
                    <tr>
                        <td style="display: none"><input type="text" name="setnewimg" value="setnewimg"></td>
                        <td><label for="img"><input type="file" name="newimg" id="newimg" required></label></td>
                        <td><button id="guardaimg" class="boton"><span><i class="far fa-save"></i></span>Guardar esta imagen</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<h3 id="titulotbl">Tabla Producto</h3>
<section id="tblProducto"></section>
</body>
</html>