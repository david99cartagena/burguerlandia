<?php
/**
 * Created by PhpStorm.
 * User: fhjua
 * Date: 23/06/2018
 * Time: 11:49 AM
 */

require_once "Model.php";

class Login extends Model
{
    private $conecta;
    private $user;
    private $password;

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

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function comprubaLogin()
    {
        try{
            sleep(1);
            $sql="SELECT usuario_usu, Password_usu FROM usuario WHERE usuario_usu = :USER AND Password_usu = :PASS";
            $stmt=$this->conecta->prepare($sql);
            $stmt->execute(array(":USER"=>$this->user, ":PASS"=>$this->password));
            if ($stmt->rowCount() != 0){
                $sql="SELECT Codigo_rol FROM usuario WHERE usuario_usu = :USER AND Password_usu = :PASS";
                $stmt=$this->conecta->prepare($sql);
                $stmt->execute(array(":USER"=>$this->user, ":PASS"=>$this->password));
                while ($registro=$stmt->fetch(PDO::FETCH_ASSOC)){
                    $rol=$registro["Codigo_rol"];
                }
                switch ($rol){
                    case 1:
                        session_start();
                        $_SESSION["admin"]=$this->user;
                        echo json_encode(array("error"=>false, "tipo"=>"Administrador"));
                        break;
                    case 2:
                        session_start();
                        $_SESSION["admin"]=$this->user;
                        echo json_encode(array("error"=>false, "tipo"=>"Usuario"));
                        break;
                    default:
                        echo json_encode(array("error"=>true, "tipo"=>"sinrol"));
                        break;
                }
            }else{
                echo json_encode(array("error"=>true, "tipo"=>"Incorrecto"));
            }
        }catch (Exception $e){
            die("ERROR: " . $e->getMessage() . " En la línea: " . $e->getLine());
        }
    }

    public function getRegistro()
    {
        // TODO: Implement getRegistro() method.
    }

    public function insertaRegistro()
    {
        // TODO: Implement insertaRegistro() method.
    }

    public function setRegistro($ident, $col, $valor)
    {
        // TODO: Implement setRegistro() method.
    }

    public function eliminaRegistro()
    {
        // TODO: Implement eliminaRegistro() method.
    }

    public function cierraSession(){
        try{
            session_start();
            $misession=$_SESSION["admin"];
            if ($misession == null){
                echo json_encode(array("result"=>true));
            }else{
                session_destroy();
                echo json_encode(array("result"=>true));
            }
        }catch (Exception $e){
            die("Error: " . $e->getMessage() . " En la linea: " . $e->getLine());
        }
    }
}