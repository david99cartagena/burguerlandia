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
        label{
            font-family: Verdana;
            font-size: 17px;
        }

        #tabla_resultado{
            width: 1000px !important;
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
                <h1 id="titulo_crud">Carrito</h1>
                <a href="products.php"><input type="button" value="Productos" class="boton"></a>
                <a href="index.php"><input type="button" value="Atras" class="boton"></a>
                <!--<a href="./products.php" class="btn btn-default">Productos</a>
                <a href="./" class="btn btn-default">Atras</a>-->
                <br><br>
                <?php
                /*
                * Esta es la consula para obtener todos los productos de la base de datos.
                */
                $products = $con->query("select * from producto");
                if(isset($_SESSION["cart"]) && !empty($_SESSION["cart"])):
                    ?>
                    <table class="table table-bordered" id="tabla_resultado">
                        <thead>

                        <th>Nombre_Producto</th>
                        <th>Valor_Producto</th>
                        <th>Descripcion_Producto</th>
                        <th></th>
                        </thead>
                        <?php
                        /*
                        * Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
                        */
                        foreach($_SESSION["cart"] as $c):
                            $products = $con->query("select * from producto where IdProducto=$c[IdProducto]");
                            $r = $products->fetch_object();
                            ?>
                            <tr>
                                <!--<th><?php echo $c["q"];?></th>-->
                                <td> <?php echo $r->Nombre_Pr; ?></td>
                                <td>$ <?php echo $c["q"]*$r->Valor_Pr; ?></td>
                                <td> <?php echo $r->Descripcion_Pr ?></td>
                                <td style="width:260px;">
                                    <?php
                                    $found = false;
                                    foreach ($_SESSION["cart"] as $c) { if($c["IdProducto"]==$r->IdProducto){ $found=true; break; }}
                                    ?>
                                    <a href="php/delfromcart.php?id=<?php echo $c["IdProducto"];?>"><input type="button" value="Eliminar" class="boton"></a>
                                    <!--<a href="php/delfromcart.php?id=<?php echo $c["IdProducto"];?>" class="btn btn-danger">Eliminar</a>-->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <form class="form-horizontal" method="post" action="./php/process.php">
                        <div class="form-group">
                            <br>
                            <label for="inputEmail3" class="col-sm-2 control-label">Email del cliente:</label>
                            <br>
                            <br>
                            <div class="col-sm-5">
                                <input type="email" name="email" required class="text" id="inputEmail3">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <br>
                                <button type="submit" class="boton">Procesar Venta</button>
                            </div>
                        </div>
                    </form>


                <?php else:?>
                    <!--<p class="alert alert-warning">El carrito esta vacio.</p>-->
                    <label>El carrito esta vacio.</label>
                <?php endif;?>
                <br><br><hr>


            </div>
        </div>
    </div>
</section>
</body>
</html>