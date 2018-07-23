<?php
session_start();
$misession=$_SESSION["admin"];
if ($misession == null){
    header("Location:../../../index.php");
}
?>
<table class="tblresult">
    <tr>
        <th>Domicilio</th>
        <th>Fecha y hora</th>
        <th>Total domicilio</th>
        <th>Usuario</th>
        <th>Medio de pago</th>
        <th>Tipo de producto</th>
        <th>Producto</th>
        <th>Restaurante</th>
        <th>&nbsp;</th>
    </tr>
    <?php
    include_once "../../../modelo/Domicilio.php";
    $objDomicilio=file_get_contents("vistaDomicilios");
    $objDomicilio=unserialize($objDomicilio);
    $stmt=$objDomicilio->getRegistro();
    while ($valor=$stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td class="corto"><?php echo $valor["Num_Domicilio"]; ?></td>
            <td class="larga" id="fechayhora" data-numdom="<?php echo $valor["Num_Domicilio"]; ?>" data-col="Fecha_y_hora_Dom"><?php echo $valor["Fecha_y_hora_Dom"]; ?></td>
            <td class="normal" id="totaldom" data-numdom="<?php echo $valor["Num_Domicilio"]; ?>" data-col="Total_Domicilio"><?php echo $valor["Total_Domicilio"]; ?></td>
            <td class="normal" id="identusu" data-numdom="<?php echo $valor["Num_Domicilio"]; ?>" data-col="Identificacion_usu"><?php echo $valor["Identificacion_usu"]; ?></td>
            <td class="corto">
                <label for="labelselectrol" id="labelselectrol">
                    <select name="selectrol" id="selectrol" data-numdom="<?php echo $valor["Num_Domicilio"]; ?>" data-col="Cod_Medios_pago">
                        <?php
                        $pdo=$objDomicilio->getConecta();
                        $sql='SELECT * FROM medios_pago';
                        $stmtt=$pdo->prepare($sql);
                        $stmtt->execute();
                        while ($fila=$stmtt->fetch(PDO::FETCH_ASSOC)) {
                            /*
                            $selected="";
                            if ($fila["Cod_Medios_pago"]==$valor["Cod_Medios_pago"]){
                                $selected="selected";
                            }
                            echo "<option value='" . $fila["Cod_Medios_pago"] . "' $selected>" . $fila["Desc_medios_pago"] . "</option>";
                            */
                            if ($fila["Cod_Medios_pago"]==$valor["Cod_Medios_pago"]){
                                echo "<option value='" . $fila["Cod_Medios_pago"] . "'>" . $fila["Desc_medios_pago"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </label>
            </td>
            <td class="larga">
                <label for="labelselectrol" id="labelselectrol">
                    <select name="selectrol" id="selectrol" data-numdom="<?php echo $valor["Num_Domicilio"]; ?>" data-col="Cod_TP">
                        <?php
                        $pdo=$objDomicilio->getConecta();
                        $sql='SELECT * FROM tipo_pedido';
                        $stmtt=$pdo->prepare($sql);
                        $stmtt->execute();
                        while ($fila=$stmtt->fetch(PDO::FETCH_ASSOC)) {
                            /*
                            $selected="";
                            if ($fila["Cod_TP"]==$valor["Cod_TP"]){
                                $selected="selected";
                            }
                            echo "<option value='" . $fila["Cod_TP"] . "' $selected>" . $fila["Desc_Tp"] . "</option>";
                            */
                            if ($fila["Cod_TP"]==$valor["Cod_TP"]){
                                echo "<option value='" . $fila["Cod_TP"] . "'>" . $fila["Desc_Tp"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </label>
            </td>
            <td class="normal">
                <label for="labelselectrol" id="labelselectrol">
                    <select name="selectrol" id="selectrol" data-numdom="<?php echo $valor["Num_Domicilio"]; ?>" data-col="IdProducto">
                        <?php
                        $pdo=$objDomicilio->getConecta();
                        $sql='SELECT * FROM producto';
                        $stmtt=$pdo->prepare($sql);
                        $stmtt->execute();
                        while ($fila=$stmtt->fetch(PDO::FETCH_ASSOC)) {
                            /*
                            $selected="";
                            if ($fila["IdProducto"]==$valor["IdProducto"]){
                                $selected="selected";
                            }
                            echo "<option value='" . $fila["IdProducto"] . "' $selected>" . $fila["Nombre_Pr"] . "</option>";
                            */
                            if ($fila["IdProducto"]==$valor["IdProducto"]){
                                echo "<option value='" . $fila["IdProducto"] . "'>" . $fila["Nombre_Pr"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </label>
            </td>
            <td class="normal">
                <label for="labelselectrol" id="labelselectrol">
                    <select name="selectrol" id="selectrol" data-numdom="<?php echo $valor["Num_Domicilio"]; ?>" data-col="Nit_rest">
                        <?php
                        $pdo=$objDomicilio->getConecta();
                        $sql='SELECT * FROM info_rest';
                        $stmtt=$pdo->prepare($sql);
                        $stmtt->execute();
                        while ($fila=$stmtt->fetch(PDO::FETCH_ASSOC)) {
                            /*
                            $selected="";
                            if ($fila["Nit_Rest"]==$valor["Nit_rest"]){
                                $selected="selected";
                            }
                            echo "<option value='" . $fila["Nit_Rest"] . "' $selected>" . $fila["Nom_rest"] . "</option>";
                            */
                            if ($fila["Nit_Rest"]==$valor["Nit_rest"]){
                                echo "<option value='" . $fila["Nit_Rest"] . "'>" . $fila["Nom_rest"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </label>
            </td>
            <td class="normal"><button id="eliminadomicilio" data-numdom="<?php echo $valor["Num_Domicilio"]; ?>" class="boton"><span><i class="fas fa-trash-alt"></i></span>Eliminar</button></td>
        </tr>
    <?php
    endwhile;
    ?>
</table>
