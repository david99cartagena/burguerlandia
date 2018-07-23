<?php
/**
 * Created by PhpStorm.
 * User: fhjua
 * Date: 23/06/2018
 * Time: 11:44 AM
 */

include_once "Model.php";

class Domicilio extends Model
{
    private $conecta;
    private $numdom;
    private $fechayhora;
    private $totaldom;
    private $identusu;
    private $mediopago;
    private $tipoprod;
    private $idprod;
    private $nitrest;

    /**
     * @param mixed $numdom
     */
    public function setNumdom($numdom)
    {
        $this->numdom = $numdom;
    }

    /**
     * @param mixed $fechayhora
     */
    public function setFechayhora($fechayhora)
    {
        $this->fechayhora = $fechayhora;
    }

    /**
     * @param mixed $totaldom
     */
    public function setTotaldom($totaldom)
    {
        $this->totaldom = $totaldom;
    }

    /**
     * @param mixed $identusu
     */
    public function setIdentusu($identusu)
    {
        $this->identusu = $identusu;
    }

    /**
     * @param mixed $mediopago
     */
    public function setMediopago($mediopago)
    {
        $this->mediopago = $mediopago;
    }

    /**
     * @param mixed $tipoprod
     */
    public function setTipoprod($tipoprod)
    {
        $this->tipoprod = $tipoprod;
    }

    /**
     * @param mixed $idprod
     */
    public function setIdprod($idprod)
    {
        $this->idprod = $idprod;
    }

    /**
     * @param mixed $nitrest
     */
    public function setNitrest($nitrest)
    {
        $this->nitrest = $nitrest;
    }

    /**
     * @return PDO
     */
    public function getConecta()
    {
        return $this->conecta;
    }

    /**
     * Domicilio constructor.
     */
    public function __construct()
    {
        $this->conecta=self::conecta();
    }

    public function getRegistro()
    {
        // TODO: Implement getRegistro() method.
        try{
            $sql="SELECT * FROM domicilio";
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
            $sql="INSERT INTO domicilio (Fecha_y_hora_Dom, Total_Domicilio, Identificacion_usu, Cod_Medios_pago, Cod_TP, IdProducto, Nit_rest)
                  VALUES (:FECHA, :TOTALDOM, :IDENTUSU, :MEDIOPAGO, :TIPOPROD, :IDPROD, :NITREST)";
            $stmt=$this->conecta->prepare($sql);
            $stmt->execute(array(":FECHA"=>$this->fechayhora, ":TOTALDOM"=>$this->totaldom, ":IDENTUSU"=>$this->identusu,
                ":MEDIOPAGO"=>$this->mediopago, ":TIPOPROD"=>$this->tipoprod, ":IDPROD"=>$this->idprod, ":NITREST"=>$this->nitrest));
            if($stmt){
                echo json_encode(array("result"=>true));
            }else{
                echo json_encode(array("result"=>false));
            }
        }catch (Exception $e){
            die("Error: " . $e->getMessage() . " En la línea: " . $e->getLine());
        }
    }

    public function setRegistro($ident, $col, $valor)
    {
        // TODO: Implement setRegistro() method.
        try{

        }catch (Exception $e){
            die("Error: " . $e->getMessage() . " En la línea: " . $e->getLine());
        }
    }

    public function eliminaRegistro()
    {
        // TODO: Implement eliminaRegistro() method.
        try{
            $sql="DELETE FROM domicilio WHERE Num_Domicilio = :IDENT";
            $stmt=$this->conecta->prepare($sql);
            $stmt->execute(array(":IDENT"=>$this->numdom));
            if($stmt){
                $sql="SELECT * FROM domicilio";
                $stmt=$this->conecta->prepare($sql);
                $stmt->execute();
                if ($stmt->rowCount() == 0){
                    $sql="ALTER TABLE domicilio AUTO_INCREMENT = 0";
                    $stmt=$this->conecta->prepare($sql);
                    $stmt->execute();
                }
                echo json_encode(array("result"=>true));
            }else{
                echo json_encode(array("result"=>false));
            }
        }catch (Exception $e){
            die("Error: " . $e->getMessage() . " En la línea: " . $e->getLine());
        }
    }

    public function __sleep()
    {
        // TODO: Implement __sleep() method.
        return array("fechayhora", "totaldom", "identusu", "mediopago", "tipoprod", "idprod", "nitrest");
    }

    public function __wakeup()
    {
        // TODO: Implement __wakeup() method.
        $this->__construct();
    }
}