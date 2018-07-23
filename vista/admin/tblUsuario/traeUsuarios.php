<?php
session_start();
$misession=$_SESSION["admin"];
if ($misession == null){
    header("Location:../../../index.php");
}
?>
<table class="tblresult">
    <tr>
        <th class="corto">Tipo doc</th>
        <th>Identificación</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>
        <th>Celular</th>
        <th>Dirección</th>
        <th>Usuario</th>
        <th>Contraseña</th>
        <th>Correo</th>
        <th>Rol</th>
        <th>&nbsp;</th>
    </tr>
<?php
include_once "../../../modelo/Usuarios.php";
$objUsuario=file_get_contents("vistaUsuarios");
$objUsuario=unserialize($objUsuario);
$stmt=$objUsuario->getRegistro();
while ($valor=$stmt->fetch(PDO::FETCH_ASSOC)): ?>
    <tr>
        <td class="corto">
            <label for="labelselectid" id="labelselectid">
                <select name='selecttipoid' id="selecttipoid" data-ident="<?php echo $valor["Identificacion_usu"]; ?>" data-col="Tipo_id">
                    <?php
                        $pdo=$objUsuario->getConecta();
                        $sql='SELECT * FROM tipo_identificacion';
                        $stmtt=$pdo->prepare($sql);
                        $stmtt->execute();
                        while ($fila=$stmtt->fetch(PDO::FETCH_ASSOC)) {
                            $selected="";
                            if ($fila["Tipo_id"]==$valor["Tipo_id"]){
                                $selected="selected";
                            }
                            echo "<option value='" . $fila["Tipo_id"] . "' $selected>" . $fila["Desc_TipoId"] . "</option>";
                        }
                    ?>
                </select>
            </label>
        </td>
        <td class="normal"><?php echo $valor["Identificacion_usu"]; ?></td>
        <td class="normal" id="nombre" data-ident="<?php echo $valor["Identificacion_usu"]; ?>" data-col="Nombre_usu"><?php echo $valor["Nombre_usu"]; ?></td>
        <td class="normal" id="apelli" data-ident="<?php echo $valor["Identificacion_usu"]; ?>" data-col="Apellido_usu"><?php echo $valor["Apellido_usu"]; ?></td>
        <td class="normal" id="telefo" data-ident="<?php echo $valor["Identificacion_usu"]; ?>" data-col="Telefono_Cl"><?php echo $valor["Telefono_Cl"] ?></td>
        <td class="normal" id="celula" data-ident="<?php echo $valor["Identificacion_usu"]; ?>" data-col="Celular_usu"><?php echo $valor["Celular_usu"]; ?></td>
        <td class="larga" id="direcc" data-ident="<?php echo $valor["Identificacion_usu"]; ?>" data-col="Direccion_usu"><?php echo $valor["Direccion_usu"]; ?></td>
        <td class="normal" id="usuari" data-ident="<?php echo $valor["Identificacion_usu"]; ?>" data-col="usuario_usu"><?php echo $valor["usuario_usu"]; ?></td>
        <td class="normal" id="contra" data-ident="<?php echo $valor["Identificacion_usu"]; ?>" data-col="Password_usu"><?php echo $valor["Password_usu"]; ?></td>
        <td class="larga" id="correo" data-ident="<?php echo $valor["Identificacion_usu"]; ?>" data-col="email_usu"><?php echo $valor["email_usu"]; ?></td>
        <td class="corto">
            <label for="labelselectrol" id="labelselectrol">
                <select name="selectrol" id="selectrol" data-ident="<?php echo $valor["Identificacion_usu"]; ?>" data-col="Codigo_rol">
                    <?php
                        $pdo=$objUsuario->getConecta();
                        $sql='SELECT * FROM rol';
                        $stmtt=$pdo->prepare($sql);
                        $stmtt->execute();
                        while ($fila=$stmtt->fetch(PDO::FETCH_ASSOC)) {
                            $selected="";
                            if ($fila["Codigo_rol"]==$valor["Codigo_rol"]){
                                $selected="selected";
                            }
                            echo "<option value='" . $fila["Codigo_rol"] . "' $selected>" . $fila["Desc_rol"] . "</option>";
                        }
                    ?>
                </select>
            </label>
        </td>
        <td class="normal"><button id="eliminausuario" data-ident="<?php echo $valor["Identificacion_usu"]; ?>" class="boton"><span><i class="fas fa-trash-alt"></i></span>Eliminar</button></td>
    </tr>
<?php
endwhile;
?>
</table>
