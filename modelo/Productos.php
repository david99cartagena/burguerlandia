<?php
/**
 * Created by PhpStorm.
 * User: fhjua
 * Date: 23/06/2018
 * Time: 11:49 AM
 */

require_once "Model.php";

class Productos extends Model
{
    private $conecta;
    private $idprod;
    private $nombreprod;
    private $valorprod;
    private $descprod;
    private $fotoprod;

    /**
     * @param mixed $idprod
     */
    public function setIdprod($idprod)
    {
        $this->idprod = $idprod;
    }

    /**
     * @param mixed $nombreprod
     */
    public function setNombreprod($nombreprod)
    {
        $this->nombreprod = $nombreprod;
    }

    /**
     * @param mixed $valorprod
     */
    public function setValorprod($valorprod)
    {
        $this->valorprod = $valorprod;
    }

    /**
     * @param mixed $descprod
     */
    public function setDescprod($descprod)
    {
        $this->descprod = $descprod;
    }

    /**
     * @param mixed $fotoprod
     */
    public function setFotoprod($fotoprod)
    {
        $this->fotoprod = $fotoprod;
    }

    /**
     * @return PDO
     */
    public function getConecta()
    {
        return $this->conecta;
    }

    /**
     * Productos constructor.
     */
    public function __construct()
    {
        $this->conecta=self::conecta();
    }

    public function getRegistro()
    {
        // TODO: Implement getRegistro() method.
        try{
            $sql="SELECT * FROM producto";
            $stmt=$this->conecta->prepare($sql);
            $stmt->execute();
            return $stmt;
        }catch (Exception $e){
            die("Error: " . $e->getMessage() . " En la línea: " . $e->getLine());
        }
    }

    public function insertaRegistro()
    {
        // TODO: Implement insertaRegistro() method.
        try{
            $sql="INSERT INTO producto (Nombre_Pr, Valor_Pr, Descripcion_Pr, Foto_Pr)
                  VALUES (:NOMBREPROD, :VALORPROD, :DESCPROD, :FOTOPROD)";
            $stmt=$this->conecta->prepare($sql);
            $stmt->execute(array(":NOMBREPROD"=>$this->nombreprod, ":VALORPROD"=>$this->valorprod,
                                 ":DESCPROD"=>$this->descprod, ":FOTOPROD"=>$this->fotoprod));
            if ($stmt){
                echo json_encode(array("result"=>true));
            }else{
                echo json_encode(array("result"=>false));
            }
        }catch (Exception $e){
            echo json_encode(array("result"=>"otro","error"=>"Error: " . $e->getMessage() . " En la línea: " . $e->getLine()));
        }
    }

    public function setRegistro($idprod, $col, $valor)
    {
        // TODO: Implement setRegistro() method.
        try{
            $sql="UPDATE producto SET $col = :VALOR WHERE IdProducto = :IDPROD";
            $stmt=$this->conecta->prepare($sql);
            $stmt->execute(array(":VALOR"=>$valor, ":IDPROD"=>$idprod));
            if($stmt){
                echo json_encode(array("result"=>true));
            }else{
                echo json_encode(array("result"=>false));
            }
        }catch (Exception $e){
            echo json_encode(array("result"=>"otro","error"=>"Error: " . $e->getMessage() . " En la línea: " . $e->getLine()));
        }
    }

    public function eliminaRegistro()
    {
        // TODO: Implement eliminaRegistro() method.
        try{
            $sql="DELETE FROM producto WHERE IdProducto = :IDPROD";
            $stmt=$this->conecta->prepare($sql);
            $stmt->execute(array(":IDPROD"=>$this->idprod));
            if($stmt){
                $sql="SELECT * FROM producto";
                $stmt=$this->conecta->prepare($sql);
                $stmt->execute();
                if ($stmt->rowCount() == 0){
                    $sql="ALTER TABLE producto AUTO_INCREMENT = 0";
                    $stmt=$this->conecta->prepare($sql);
                    $stmt->execute();
                }
                echo json_encode(array("result"=>true));
            }else{
                echo json_encode(array("result"=>false));
            }
        }catch (Exception $e){
            echo json_encode(array("result"=>"otro","error"=>"Error: " . $e->getMessage() . " En la línea: " . $e->getLine()));
        }
    }

    public function __sleep()
    {
        // TODO: Implement __sleep() method.
        return array("nombreprod", "valorprod", "descprod", "fotoprod");
    }

    public function __wakeup()
    {
        // TODO: Implement __wakeup() method.
        $this->__construct();
    }
}