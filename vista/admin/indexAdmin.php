<?php
/**
 * Created by PhpStorm.
 * User: fhjua
 * Date: 23/06/2018
 * Time: 6:56 PM
 */
require "../../modelo/Usuarios.php";

session_start();
$misession=$_SESSION["admin"];
if ($misession == null){
    header("Location:../../index.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <link rel="stylesheet" href="../css/fontawesome/css/all.css">
    <link rel="stylesheet" href="../css/estilosgenerales.css">
    <link rel="stylesheet" href="../css/indexAdmin.css">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/indexAdmin.js"></script>
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
<section id="opciones">
    <div id="opcionUno"><a href="?tabla=usuario"><span><i class="fas fa-table"></i></span>Usuarios</a></div>
    <div id="opcionDos"><a href="?tabla=producto"><span><i class="fas fa-table"></i></span>Productos</a></div>
    <div id="opcionTres"><a href="?tabla=domicilio"><span><i class="fas fa-table"></i></span>Domicilios</a></div>
    <div id="opcionCuatro"><a href="../../controlador/controller.php?tbl=opinion"><span><i class="fas fa-table"></i></span>Opiniones</a></div>
</section>
<?php
if (isset($_GET["tabla"])){
    switch ($_GET["tabla"]):
        case "usuario":?>
            <section class="contenedorform">
                <form id="formUsuario">
                    <table class="tblform">
                        <tr>
                            <td style="display: none"><label for="enviaUsuario"><input type="text" name="enviaUsuario" value="enviausuario"></label></td>
                            <td><label for="tipoid">Tipo identificación:</label></td>
                            <td class="col">
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
                            </td>
                            <td><label for="direccion">Dirección residencial:</label></td>
                            <td class="col"><label for="direccion">
                                    <input type="text" name="dir" class="text" required>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="identificacion">Número de identificación:</label></td>
                            <td class="col"><label for="iden"><input type="number" name="iden" class="text" required></label></td>
                            <td><label for="usu">Usuario:</label></td>
                            <td class="col"><label for="usu"><input type="text" name="usu" class="text"></label></td>
                        </tr>
                        <tr>
                            <td><label for="nombre">Nombre:</label></td>
                            <td class="col"><label for="nom"><input type="text" name="nombre" class="text" required></label></td>
                            <td><label for="pass">Contraseña:</label></td>
                            <td class="col"><label for="pass"><input type="password" name="pass" class="text" required></label></td>
                        </tr>
                        <tr>
                            <td><label for="apellido">Apellido:</label></td>
                            <td class="col"><label for="ape"><input type="text" name="apellido" class="text" required></label></td>
                            <td><label for="email">Correo electrónico:</label></td>
                            <td class="col"><label for="email"><input type="email" name="email" class="text" required></label></td>
                        </tr>
                        <tr>
                            <td><label for="tel">Teléfono:</label></td>
                            <td class="col"><label for="tel"><input type="number" name="tel" class="text"></label></td>
                            <td><label for="rol">Rol:</label></td>
                            <td class="col">
                                <label for="rol">
                                    <select name="rol" required>
                                        <option value="">Seleccionar...</option>
                                        <?php
                                            $objUsuario=new Usuario();
                                            $pdo=$objUsuario->getConecta();
                                            $sql="SELECT * FROM rol";
                                            $stmt=$pdo->prepare($sql);
                                            $stmt->execute();
                                            while ($fila=$stmt->fetch(PDO::FETCH_ASSOC)):
                                        ?>
                                        <option value="<?php echo $fila["Codigo_rol"]; ?>"><?php echo $fila["Desc_rol"]; ?></option>
                                        <?php endwhile;  ?>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="cel">Celular:</label></td>
                            <td class="col"><label for="cel"><input type="number" name="cel" class="text" required></label></td>
                            <td colspan="2" id="ultima">
                                <button type="submit" class="boton"><span><i class="far fa-save"></i></span>Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <table class="tblform" style="margin-top: -6px;">
                    <tr>
                        <td style="width: 273px;border-right: none;border-bottom: none;border-left: none;border-top: none">&nbsp;</td>
                        <td class="col" style="border-left: none;border-bottom: none;border-top: none">&nbsp;</td>
                        <td colspan="2" style="border-top: none">
                            <a href="../../controlador/controller.php?tbl=usuario">
                                <button class="boton" id="vistausuarios"><span><i class="fas fa-users"></i></span>Ver usuarios</button>
                            </a>
                        </td>
                    </tr>
                </table>
            </section>
<?php
            break;
        case "producto":?>
            <section class="contenedorform">
                <form id="formProducto" enctype="multipart/form-data">
                    <table class="tblform">
                        <tr>
                            <td style="display: none"><label for="enviaProducto"><input type="text" name="enviaProducto" value="enviaproducto"></label></td>

                            <td><label for="nombreprod">Nombre del producto:</label></td>
                            <td class="col"><label for="nombreprod"><input type="text" name="nombreprod" class="text" required"></label></td>
                            <td><label for="valorprod">Valor del producto:</label></td>
                            <td class="col"><label for="valorprod"><input type="number" name="valorprod" class="text" required></label></td>
                        </tr>
                        <tr>
                            <td><label for="descprod">Descripción del producto:</label></td>
                            <td class="col" colspan="3"><label for="descprod"><textarea class="texttarea" name="descprod"></textarea></label></td>
                        </tr>
                        <tr>
                            <td><label for="nombre">Imagen del producto:</label></td>
                            <td><input type="file" name="imagenprod" id="imagenprod"></td>
                            <td colspan="2" id="ultima">
                                <button type="submit" class="boton"><span><i class="far fa-save"></i></span>Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <table class="tblform" style="margin-top: -6px;">
                    <tr>
                        <td style="width: 314px;border-right: none;border-bottom: none;border-left: none;border-top: none">&nbsp;</td>
                        <td class="col" style="border-left: none;border-bottom: none;border-top: none">&nbsp;</td>
                        <td colspan="2" style="border-top: none;">
                            <a href="../../controlador/controller.php?tbl=producto">
                                <button class="boton" id="vistausuarios"><span><i class="fas fa-users"></i></span>Ver productos</button>
                            </a>
                        </td>
                    </tr>
                </table>
            </section>
<?php
            break;
        case "domicilio":?>
            <section class="contenedorform">
                <form id="formDomicilio">
                    <table class="tblform">
                        <tr>
                            <td style="display: none"><label for="enviaDomicilio"><input type="text" name="enviaDomicilio" value="enviaDomicilio"></label></td>

                            <td><label for="totaldom">Total domicilio:</label></td>
                            <td class="col"><label for="totaldom"><input type="number" name="totaldom" class="text" required"></label></td>
                            <td><label for="identusu">Número de identificación:</label></td>
                            <td class="col">
                                <label for="identusu">
                                    <select name="identusu" required>
                                        <option value="">Seleccionar...</option>
                                        <?php
                                        $objUsuario=new Usuario();
                                        $pdo=$objUsuario->getConecta();
                                        $sql="SELECT * FROM usuario";
                                        $stmt=$pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($fila=$stmt->fetch(PDO::FETCH_ASSOC)):
                                            ?>
                                            <option value="<?php echo $fila["Identificacion_usu"]; ?>"><?php echo $fila["Identificacion_usu"]; ?></option>
                                        <?php endwhile;  ?>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="mediopago">Medio de pago:</label></td>
                            <td class="col">
                                <label for="mediopago">
                                    <select name="mediopago" required>
                                        <option value="">Seleccionar...</option>
                                        <?php
                                        $objUsuario=new Usuario();
                                        $pdo=$objUsuario->getConecta();
                                        $sql="SELECT * FROM medios_pago";
                                        $stmt=$pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($fila=$stmt->fetch(PDO::FETCH_ASSOC)):
                                            ?>
                                            <option value="<?php echo $fila["Cod_Medios_pago"]; ?>"><?php echo $fila["Desc_medios_pago"]; ?></option>
                                        <?php endwhile;  ?>
                                    </select>
                                </label>
                            </td>
                            <td><label for="tipopedido">Tipo de pedido:</label></td>
                            <td class="col">
                                <label for="tipopedido">
                                    <select name="tipopedido" required>
                                        <option value="">Seleccionar...</option>
                                        <?php
                                        $objUsuario=new Usuario();
                                        $pdo=$objUsuario->getConecta();
                                        $sql="SELECT * FROM tipo_pedido";
                                        $stmt=$pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($fila=$stmt->fetch(PDO::FETCH_ASSOC)):
                                            ?>
                                            <option value="<?php echo $fila["Cod_TP"]; ?>"><?php echo $fila["Desc_Tp"]; ?></option>
                                        <?php endwhile;  ?>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="idproducto">Producto:</label></td>
                            <td class="col">
                                <label for="idproducto">
                                    <select name="idproducto" required>
                                        <option value="">Seleccionar...</option>
                                        <?php
                                        $objUsuario=new Usuario();
                                        $pdo=$objUsuario->getConecta();
                                        $sql="SELECT * FROM producto";
                                        $stmt=$pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($fila=$stmt->fetch(PDO::FETCH_ASSOC)):
                                            ?>
                                            <option value="<?php echo $fila["IdProducto"]; ?>"><?php echo $fila["Descripcion_Pr"]; ?></option>
                                        <?php endwhile;  ?>
                                    </select>
                                </label>
                            </td>
                            <td><label for="restaurante">Restaurante:</label></td>
                            <td class="col">
                                <label for="restaurante">
                                    <select name="restaurante" required>
                                        <option value="">Seleccionar...</option>
                                        <?php
                                        $objUsuario=new Usuario();
                                        $pdo=$objUsuario->getConecta();
                                        $sql="SELECT * FROM info_rest";
                                        $stmt=$pdo->prepare($sql);
                                        $stmt->execute();
                                        while ($fila=$stmt->fetch(PDO::FETCH_ASSOC)):
                                            ?>
                                            <option value="<?php echo $fila["Nit_Rest"]; ?>"><?php echo $fila["Nom_rest"]; ?></option>
                                        <?php endwhile;  ?>
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width: 188px;border-right: none;border-bottom: none;border-left: none;border-top: none">&nbsp;</td>
                            <td colspan="2" id="ultima"><button type="submit" class="boton"><span><i class="far fa-save"></i></span>Guardar</button></td>
                        </tr>
                    </table>
                </form>
                <table class="tblform" style="margin-top: -6px;">
                    <tr>
                        <td style="width: 188px;border-right: none;border-bottom: none;border-left: none;border-top: none">&nbsp;</td>
                        <td class="col" style="border-left: none;border-bottom: none;border-top: none">&nbsp;</td>
                        <td colspan="2" style="border-top: none;">
                            <a href="../../controlador/controller.php?tbl=domicilio">
                                <button class="boton" id="vistadomicilios"><span><i class="fas fa-users"></i></span>Ver domicilios</button>
                            </a>
                        </td>
                    </tr>
                </table>
            </section>
<?php
            break;
    endswitch;
}
?>
</body>
</html>