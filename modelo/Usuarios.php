<?php
/**
 * Created by PhpStorm.
 * User: fhjua
 * Date: 23/06/2018
 * Time: 11:49 AM
 */

require_once "Model.php";

class Usuario extends Model
{
    private $conecta;
    private $tipoDoc;
    private $identificacion;
    private $nombre;
    private $apellido;
    private $telefono;
    private $celular;
    private $direccion;
    private $usuario;
    private $contrasena;
    private $email;
    private $rol;

    /**
     * Productos constructor.
     */
    public function __construct()
    {
        $this->conecta=self::conecta();
    }

    /**
     * @param mixed $tipoDoc
     */
    public function setTipoDoc($tipoDoc)
    {
        $this->tipoDoc = $tipoDoc;
    }

    /**
     * @param mixed $identificacion
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @param mixed $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @param mixed $contrasena
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
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
            $sql="SELECT * FROM usuario";
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
            $sql="INSERT INTO usuario (Identificacion_usu, Nombre_usu, Apellido_usu, Telefono_Cl, 
                                       Celular_usu, Direccion_usu, usuario_usu, Password_usu, 
                                       email_usu, Codigo_rol, Tipo_id) 
                                       VALUES (:IDEN, :NOMBRE, :APELLIDO, :TEL, :CEL, :DIR, :USER, :PASS, :EMAIL, :ROL, :TIPOID)";
            $stmt=$this->conecta->prepare($sql);
            $stmt->execute(array(":IDEN"=>$this->identificacion, ":NOMBRE"=>$this->nombre, ":APELLIDO"=>$this->apellido,
                                 ":TEL"=>$this->telefono, ":CEL"=>$this->celular, ":DIR"=>$this->direccion, ":USER"=>$this->usuario,
                                 ":PASS"=>$this->contrasena, ":EMAIL"=>$this->email, ":ROL"=>$this->rol, ":TIPOID"=>$this->tipoDoc));
            if($stmt){
                echo json_encode(array("result"=>true));
            }else{
                echo json_encode(array("result"=>false));
            }
        }catch (Exception $e){
            echo json_encode(array("result"=>"otro","error"=>"Error: " . $e->getMessage() . " En la línea: " . $e->getLine()));
        }
    }

    public function setRegistro($ident, $col, $valor)
    {
        // TODO: Implement setRegistro() method.
        try{
            $sql="UPDATE usuario SET $col = :VALOR WHERE Identificacion_usu = :IDENT";
            $stmt=$this->conecta->prepare($sql);
            $stmt->execute(array(":VALOR"=>$valor, ":IDENT"=>$ident));
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
            $sql="DELETE FROM usuario WHERE Identificacion_usu = :IDENT";
            $stmt=$this->conecta->prepare($sql);
            $stmt->execute(array(":IDENT"=>$this->identificacion));
            if($stmt){
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
        return array("tipoDoc", "identificacion", "nombre", "apellido", "telefono", "celular",
                     "direccion", "usuario", "contrasena", "email", "rol");
    }

    public function __wakeup()
    {
        // TODO: Implement __wakeup() method.
        $this->__construct();
    }
}