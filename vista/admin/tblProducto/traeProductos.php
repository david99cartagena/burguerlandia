<?php
session_start();
$misession=$_SESSION["admin"];
if ($misession == null){
    header("Location:../../../index.php");
}
?>
<table class="tblresult">
    <tr>
        <th class="corto">ID</th>
        <th>Nombre producto</th>
        <th>Valor producto</th>
        <th>Descripción producto</th>
        <th>Imagen producto</th>
        <th>&nbsp;</th>
    </tr>
    <?php
    include_once "../../../modelo/Productos.php";
    $objProducto=file_get_contents("vistaProductos");
    $objProducto=unserialize($objProducto);
    $stmt=$objProducto->getRegistro();
    while ($valor=$stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td class="corto"><?php echo $valor["IdProducto"]; ?></td>
            <td class="normal" id="nombreprod" data-idprod="<?php echo $valor["IdProducto"]; ?>" data-col="Nombre_Pr"><?php echo $valor["Nombre_Pr"]; ?></td>
            <td class="normal" id="valorprod" data-idprod="<?php echo $valor["IdProducto"]; ?>" data-col="Valor_Pr"><?php echo $valor["Valor_Pr"]; ?></td>
            <td class="larga" id="descprod" data-idprod="<?php echo $valor["IdProducto"]; ?>" data-col="Descripcion_Pr"><?php echo $valor["Descripcion_Pr"]; ?></td>
            <td class="normal" id="colimagen" data-idprod="<?php echo $valor["IdProducto"]; ?>" data-col="Foto_Pr" data-nombre="<?php echo $valor['Foto_Pr']; ?>"><img src="/WampProjects/Burguerlandia/vista/img/productos/<?php echo $valor['Foto_Pr']; ?>" id="imgprod"></td>
            <td class="normal"><button id="eliminaproducto" data-idprod="<?php echo $valor["IdProducto"]; ?>" class="boton"><span><i class="fas fa-trash-alt"></i></span>Eliminar</button></td>
        </tr>
    <?php
    endwhile;
    ?>
</table>
