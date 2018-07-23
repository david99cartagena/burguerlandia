<?php
/**
 * Created by PhpStorm.
 * User: fhjua
 * Date: 23/06/2018
 * Time: 12:12 PM
 */

include_once "Conexion.php";

abstract class Model extends Conexion {

    abstract public function getRegistro();

    abstract public function insertaRegistro();

    abstract public function setRegistro($ident, $col, $valor);

    abstract public function eliminaRegistro();

}