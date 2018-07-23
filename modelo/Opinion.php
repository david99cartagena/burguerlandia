<?php
/**
 * Created by PhpStorm.
 * User: fhjua
 * Date: 14/07/2018
 * Time: 7:25 PM
 */

require_once "Model.php";

class Opinion extends Model
{

    private $conecta;
    private $idopinion;
    private $opinion;
    private $identusu;

    /**
     * @param mixed $idopinion
     */
    public function setIdopinion($idopinion)
    {
        $this->idopinion = $idopinion;
    }

    /**
     * @param mixed $opinion
     */
    public function setOpinion($opinion)
    {
        $this->opinion = $opinion;
    }

    /**
     * @param mixed $identusu
     */
    public function setIdentusu($identusu)
    {
        $this->identusu = $identusu;
    }

    /**
     * Opinion constructor.
     */
    public function __construct()
    {
        $this->conecta=self::conecta();
    }

    /**
     * @return PDO
     */
    public function getConecta()
    {
        return $this->conecta;
    }

    public function getRegistro()
    {
        // TODO: Implement getRegistro() method.
        try{
            $sql="SELECT * FROM opinion";
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
            die("Error: " . $e->getMessage() . " En la línea: " . $e->getLine());
        }
    }

    public function setRegistro($ident, $col, $valor)
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
            die("Error: " . $e->getMessage() . " En la línea: " . $e->getLine());
        }
    }

    public function eliminaRegistro()
    {
        // TODO: Implement eliminaRegistro() method.
        try{
            $sql="DELETE FROM opinion WHERE Id_Opinion = :IDOPI";
            $stmt=$this->conecta->prepare($sql);
            $stmt->execute(array(":IDOPI"=>$this->idopinion));
            if($stmt){
                $sql="SELECT * FROM opinion";
                $stmt=$this->conecta->prepare($sql);
                $stmt->execute();
                if ($stmt->rowCount() == 0){
                    $sql="ALTER TABLE opinion AUTO_INCREMENT = 0";
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
        return array("idopinion", "opinion", "identusu");
    }

    public function __wakeup()
    {
        // TODO: Implement __wakeup() method.
        $this->__construct();
    }
}