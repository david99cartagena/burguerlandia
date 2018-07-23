<?php
session_start();
$misession=$_SESSION["admin"];
if ($misession == null){
    header("Location:../../../index.php");
}
?>
<table class="tblresult">
    <tr>
        <th>Id</th>
        <th>Opinion</th>
        <th>Usuario</th>
        <th>&nbsp;</th>
    </tr>
    <?php
    include_once "../../../modelo/Opinion.php";
    $objOpinion=file_get_contents("vistaOpinion");
    $objOpinion=unserialize($objOpinion);
    $stmt=$objOpinion->getRegistro();
    while ($valor=$stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td class="corto"><?php echo $valor["Id_Opinion"]; ?></td>
            <td class="larga" id="nombre" data-idopi="<?php echo $valor["Id_Opinion"]; ?>" data-col="Opinion"><?php echo $valor["Opinion"]; ?></td>
            <td class="normal" id="apelli" data-idopi="<?php echo $valor["Id_Opinion"]; ?>" data-col="Identificacion_usu"><?php echo $valor["Identificacion_usu"]; ?></td>
            <td class="normal"><button id="eliminaopinion" data-idopi="<?php echo $valor["Id_Opinion"]; ?>" class="boton"><span><i class="fas fa-trash-alt"></i></span>Eliminar</button></td>
        </tr>
    <?php
    endwhile;
    ?>
</table>
