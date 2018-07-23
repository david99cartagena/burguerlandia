<?php
/**
 * Created by PhpStorm.
 * User: fhjua
 * Date: 23/06/2018
 * Time: 9:37 AM
 */
require_once "config.php";

class Conexion
{
    protected static function conecta()
    {
        try
        {
            $conect=new PDO("mysql:host=".HOST."; dbname=".DBNAME.";", USER, PASSWORD);
            $conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conect->exec("SET CHARACTER SET UTF8");
            return $conect;
        }catch (Exception $e)
        {
            die("Error: " . $e->getMessage() . " En la línea: " . $e->getLine());
        }
    }
}
