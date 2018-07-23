<?php
/**
 * Created by PhpStorm.
 * User: fhjua
 * Date: 23/06/2018
 * Time: 12:17 PM
 */
include "../modelo/Domicilio.php";
include "../modelo/Login.php";
include "../modelo/Productos.php";
include "../modelo/Usuarios.php";
include "../modelo/Opinion.php";

if(isset($_POST["enviaLogin"])){
    //ENVIA LOS DATOS DEL LOGIN
    $objLogin=new Login();
    $objLogin->setUser(addslashes($_POST["usuario"]));
    $objLogin->setPassword(addslashes($_POST["contrasena"]));
    $objLogin->comprubaLogin();
}if(isset($_POST["session"])){
    //CIERRA LA SESSION
    $objLogin=new Login();
    $objLogin->cierraSession();
}elseif (isset($_GET["tbl"])){
    //ESCOGE LA TABLA A MOSTRAR EN indexAdmin
    switch ($_GET["tbl"]){
        case "usuario":
            $objUsuario=new Usuario();
            $objUsuario=serialize($objUsuario);
            file_put_contents("../vista/admin/tblUsuario/vistaUsuarios", $objUsuario);
            header("Location:../vista/admin/tblUsuario/vistaUsuarios.php");
            break;
        case "domicilio":
            $objDomicilio=new Domicilio();
            $objDomicilio=serialize($objDomicilio);
            file_put_contents("../vista/admin/tblDomicilio/vistaDomicilios", $objDomicilio);
            header("Location:../vista/admin/tblDomicilio/vistaDomicilios.php");
            break;
        case "producto":
            $objProducto=new Productos();
            $objProducto=serialize($objProducto);
            file_put_contents("../vista/admin/tblProducto/vistaProductos", $objProducto);
            header("Location:../vista/admin/tblProducto/vistaProductos.php");
            break;
        case "opinion":
            $objOpinion=new Opinion();
            $objOpinion=serialize($objOpinion);
            file_put_contents("../vista/admin/tblOpinion/vistaOpinion", $objOpinion);
            header("Location:../vista/admin/tblOpinion/vistaOpinion.php");
            break;
        default:
            echo "<script>alert('Esta tabla no existe');</script>";
            break;
    }
}elseif (isset($_POST["enviaUsuario"])){
    //----------------------------------T A B L A  U S U A R I O-------------------------------
    //INSERTA EN LA TABLA USUARIO
    $objUsuario=new Usuario();
    $objUsuario->setTipoDoc($_POST["tipoid"]);
    $objUsuario->setDireccion(addslashes($_POST["dir"]));
    $objUsuario->setIdentificacion(addslashes($_POST["iden"]));
    $objUsuario->setUsuario(addslashes($_POST["usu"]));
    $objUsuario->setNombre(addslashes($_POST["nombre"]));
    $objUsuario->setContrasena(addslashes($_POST["pass"]));
    $objUsuario->setApellido(addslashes($_POST["apellido"]));
    $objUsuario->setEmail(addslashes($_POST["email"]));
    $objUsuario->setTelefono(addslashes($_POST["tel"]));
    $objUsuario->setRol($_POST["rol"]);
    $objUsuario->setCelular(addslashes($_POST["cel"]));
    $objUsuario->insertaRegistro();
}elseif(isset($_POST["deleteUsuario"])){
    //ELIMINA UN USUARIO
    $objUsuario=new Usuario();
    $objUsuario->setIdentificacion(addslashes($_POST["ident"]));
    $objUsuario->eliminaRegistro();
}elseif (isset($_POST["setUsuario"])){
    //ACTUALIZA UN USUARIO
    $objUsuario=new Usuario();
    $objUsuario->setRegistro($_POST["ident"], $_POST["col"], $_POST["valor"]);
}elseif (isset($_POST["enviaProducto"])){
    //------------------------------------T A B L A  P R O D U C T O-----------------------------
    //INSERTA EN LA TABLA PRODUCTO

    //guardamos el nombre de la imagen
    $nombreImagen = $_FILES["imagenprod"]["name"];
    //guardamos el tipo de imagen
    $tipoImagen = $_FILES['imagenprod']['type'];
    //guardamos el tamaño de la imagen
    $tamanoImagen = $_FILES["imagenprod"]["size"];

    if($tamanoImagen <= 3000000) {
        if($tipoImagen == "image/png" || $tipoImagen == "image/jpg" || $tipoImagen == "image/gif" || $tipoImagen == "image/jpeg") {
            //guardamos el lugar en donde se va a guardar la imagen
            $carpetaDestino = $_SERVER["DOCUMENT_ROOT"] . "/WampProjects/Burguerlandia/vista/img/productos/";
            //pasamos la imagen de la carpeta temporal a la carpeta donde se va a almacenar
            move_uploaded_file($_FILES["imagenprod"]["tmp_name"], $carpetaDestino . $nombreImagen);
            $objProducto=new Productos();
            $objProducto->setNombreprod(addslashes($_POST["nombreprod"]));
            $objProducto->setValorprod(addslashes($_POST["valorprod"]));
            $objProducto->setDescprod(addslashes($_POST["descprod"]));
            $objProducto->setFotoprod($nombreImagen);
            $objProducto->insertaRegistro();
        }else{
            echo json_encode(array("result"=>"errordeformatoimagen"));
        }
    }else{
        echo json_encode(array("result"=>"errordetamano"));
    }
}elseif(isset($_POST["deleteProducto"])){
    //ELIMINA UN PRODUCTO
    $objProducto=new Productos();
    $objProducto->setIdprod(addslashes($_POST["idprod"]));
    $objProducto->eliminaRegistro();
}elseif (isset($_POST["setProducto"])){
    //ACTUALIZA UN PRODUCTO
    $objProducto=new Productos();
    $idprod=addslashes($_POST["idprod"]);
    $col=addslashes($_POST["col"]);
    $valor=addslashes($_POST["valor"]);
    $objProducto->setRegistro($idprod, $col, $valor);
}elseif (isset($_POST["setnewimg"])){
    //ACTUALIZA LA IMAGEN DE UN PRODUCTO
    $nombreImagen = $_FILES["newimg"]["name"];
    $tipoImagen = $_FILES["newimg"]["type"];
    $tamanoImagen = $_FILES["newimg"]["size"];
    if($tamanoImagen <= 3000000) {
        if($tipoImagen == "image/png" || $tipoImagen == "image/jpeg" || $tipoImagen == "image/gif" || $tipoImagen == "image/jpg") {
            //guardamos el lugar en donde se va a guardar la imagen
            $carpetaDestino = $_SERVER["DOCUMENT_ROOT"] . "/WampProjects/Burguerlandia/vista/img/productos/";
            //Eliminamos la imgagen actual
            unlink($carpetaDestino.$_POST["nombre"]);
            //pasamos la imagen de la carpeta temporal a la carpeta donde se va a almacenar
            move_uploaded_file($_FILES["newimg"]["tmp_name"], $carpetaDestino . $nombreImagen);
            $objProducto=new Productos();
            $idprod=addslashes($_POST["idprod"]);
            $col=addslashes($_POST["col"]);
            $objProducto->setRegistro($idprod, $col, $nombreImagen);
        }else{
            echo json_encode(array("result"=>"errordeformatoimagen"));
        }
    }else{
        echo json_encode(array("result"=>"errordetamano"));
    }
}elseif (isset($_POST["enviaDomicilio"])){
    //------------------------------------T A B L A  D O M I C I L I O-----------------------------
    //INSERTA EN LA TABLA DOMICILIO

    date_default_timezone_set("America/Bogota");
    $fecha=date("Y-m-d H:i:s");

    $objDomicilio=new Domicilio();
    $objDomicilio->setFechayhora($fecha);
    $objDomicilio->setTotaldom(addslashes($_POST["totaldom"]));
    $objDomicilio->setIdentusu($_POST["identusu"]);
    $objDomicilio->setMediopago($_POST["mediopago"]);
    $objDomicilio->setTipoprod($_POST["tipopedido"]);
    $objDomicilio->setIdprod($_POST["idproducto"]);
    $objDomicilio->setNitrest($_POST["restaurante"]);
    $objDomicilio->insertaRegistro();
}elseif(isset($_POST["deleteDomicilio"])){
    //ELIMINA UN PRODUCTO
    $objDomicilio=new Domicilio();
    $objDomicilio->setNumdom($_POST["numdom"]);
    $objDomicilio->eliminaRegistro();
}elseif(isset($_POST["deleteOpinion"])){
    //------------------------------------T A B L A  O P I N I O N-----------------------------
    //ELIMINA UN PRODUCTO
    $objOpinion=new Opinion();
    $objOpinion->setIdopinion($_POST["idopi"]);
    $objOpinion->eliminaRegistro();
}elseif (isset($_POST["enviaRegistro"])) {
    //---------------------I N S E R T A   R E G I S T R O   U S U A R I O------------------------
    //INSERTA EN LA TABLA USUARIO    
    $pass=addslashes($_POST["pass"]);
    $passdos=addslashes($_POST["passdos"]);
    //Comparo las contraseñas
    if ($pass==$passdos) {
        $objUsuario=new Usuario();
        $objUsuario->setTipoDoc($_POST["tipoid"]);
        $objUsuario->setIdentificacion(addslashes($_POST["iden"]));
        $objUsuario->setNombre(addslashes($_POST["nombre"]));
        $objUsuario->setApellido(addslashes($_POST["apellido"]));
        $objUsuario->setTelefono(addslashes($_POST["tel"]));
        $objUsuario->setCelular(addslashes($_POST["cel"]));
        $objUsuario->setDireccion(addslashes($_POST["dir"]));
        $objUsuario->setEmail(addslashes($_POST["email"]));
        $objUsuario->setUsuario(addslashes($_POST["usu"]));
        $objUsuario->setContrasena($pass);
        $objUsuario->setRol("2");
        $objUsuario->insertaRegistro();
    }else{
        echo json_encode(array("result"=>"passinvalidas"));   
    }
}
