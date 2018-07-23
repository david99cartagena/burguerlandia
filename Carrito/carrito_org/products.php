<?php
/*
* Este archio muestra los productos en una tabla.
*/
session_start();
include "php/conection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!--<link rel="stylesheet" type="text/css" href="bootstrap.min.css">-->
    <link rel="stylesheet" href="../../css/estilos.css">
    <style>
        #main-content{
            width: 1200px !important;
        }

        #tabla_resultado{
            width: 1200px !important;
        }
    </style>
</head>
<body>
<header id="header_principal">
    <nav>
        <ul>
            <li><a href="../../index.php">Inicio</a></li>
            <li><a href="">Clientes</a></li>
            <li><a href="index.php">Productos</a></li>
            <li><a href="../../login/Login.php">Iniciar Sesion</a></li>
            <li><a href="">Informacion</a></li>
            <li><a href="">Domicilios</a></li>
        </ul>
    </nav>
</header>
<section id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 id="titulo_crud"> Nuestros Productos</h1>
                <a href="cart.php"><input type="button" value="Ver carrito" class="boton"></a>
                <a href="index.php"><input type="button" value="Atras" class="boton"></a>
                <!--<a href="./cart.php" class="btn btn-warning">Ver Carrito</a>
                <a href="./" class="btn btn-warning">Atras</a>-->
                <br><br>
                <?php
                /*
                * Esta es la consula para obtener todos los productos de la base de datos.
                */
                $products = $con->query("select * from producto");
                ?>
                <table class="table table-bordered" id="tabla_resultado">
                    <thead>
                    <th>Id </th>
                    <th>Nombre Producto</th>
                    <th>Valor Producto</th>
                    <th>Descripcion Producto</th>
                    <th></th>
                    </thead>
                    <?php
                    /*
                    * Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
                    */
                    while($r=$products->fetch_object()):?>
                        <tr>
                            <td> <?php echo $r->IdProducto; ?></td>
                            <td> <?php echo $r->Nombre_Pr; ?></td>
                            <td>$ <?php echo $r->Valor_Pr; ?></td>
                            <td> <?php echo $r->Descripcion_Pr ?></td>
                            <td style="width:260px;">
                                <?php
                                $found = false;

                                if(isset($_SESSION["cart"])){
                                    foreach ($_SESSION["cart"] as $c){
                                        if($c["IdProducto"]==$r->IdProducto){
                                            $found=true;
                                            break;
                                        }
                                    }
                                }
                                ?>
                                <?php if($found):?>
                                    <input type="button" value="Agregado" class="boton">
                                    <!--<a href="cart.php" class="btn btn-info">Agregado</a>-->
                                <?php else:?>
                                    <form class="form-inline" method="post" action="./php/addtocart.php">
                                        <input type="hidden" name="IdProducto" value="<?php echo $r->IdProducto; ?>">
                                        <div class="form-group">
                                            <input type="number" name="q" value="1" style="width:100px;" min="1" class="text" placeholder="Cantidad">
                                        </div>
                                        <button type="submit" class="boton">Agregar al carrito</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
                <br><br><hr>

            </div>
        </div>
    </div>
</section>
</body>
</html>