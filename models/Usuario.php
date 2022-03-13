<?php

namespace Model;

class Usuario extends ActiveRecord {
    
    //BASE DE DATOS
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 
    'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    //MENSAJES DE VALIDACIÒN PARA LA CREACIÓN DE UNA CUENTA
    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }

        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }

        if(!$this->telefono) {
            self::$alertas['error'][] = 'El Teléfono es Obligatorio';
        }

        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña es Obligatoria';
        }

        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La Contraseña debe tener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El E-mail es obligatorio';
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña es obligatoria';
        }

        return self::$alertas;
    }

    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El E-mail es obligatorio';
        }

        return self::$alertas;
    }

    public function validarPasword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña es obligatoria';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'La Contraseña debe tener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    //REVISA SI EL USUSARIO YA EXISTE
    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            self::$alertas['error'][] = 'El Usuario ya está registrado';
        }

        return $resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function crearToken() {
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password) {
        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Constraseña Incorrecta o Tu Cuenta no a Sido Confirmada';
        } else {
            return true;
        }
    }
}