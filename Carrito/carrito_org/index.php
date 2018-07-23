<!DOCTYPE html>
<html>
<head>
	<title>Carrito de Compras</title>
	<!--<link rel="stylesheet" type="text/css" href="bootstrap.min.css">-->
    <link rel="stylesheet" href="../../css/estilos.css">
    <style>
        #titulo_formulario{
            width: 190px !important;
            font-style: normal !important;
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
                <h1 id="titulo_crud"> Carrito de Compras Burguerlandia </h1>
                <p id="titulo_formulario"> Menu de Opciones </p>
                <br>
                <a href="products.php"><input type="button" value="Productos" class="boton"></a>
                <a href="cart.php"><input type="button" value="Carrito" class="boton"></a>
                <!--
                <a href="./products.php" class="btn btn-default">Productos</a>
                <a href="./cart.php" class="btn btn-default">Carrito</a>
                <tr><a href="../../index.php" class="btn btn-default">Atras</a>-->
            </div>
        </div>
    </div>
</section>
</body>
</html>