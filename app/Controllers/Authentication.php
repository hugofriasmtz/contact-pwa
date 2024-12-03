<?php
namespace App\Controllers;
session_start();

use App\Models\Model;
use App\Helpers\Alerts;
use App\Helpers\Helpers;

class Authentication{

    private $Model;
    private $_helper;
    private $_alerts;

    function __construct(){
        $this->Model = new Model();
        $this->_helper = new Helpers();
        $this->_alerts = new Alerts();
    }

    public function index(){
        include_once "./index.html";
    }

    public function IsAuth(){
        return (isset($_SESSION['user']));
    }

    public function GetUserAtuh(){
        //Si no existe la sesión de user sacarlo
        if( !isset($_SESSION['user']) ){

        }
        return $_SESSION['user'];
    }

    public function AuthUser(){
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $this->validateAccess($_POST['username'], $_POST['password']);
        }
    }

    public function validateAccess($username, $password){

        $alerta     = ['title' => '', 'body' => '', 'type' => '', 'location' => ''];
        $username   = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        $password   = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
        $user       = $this->Model->SearchUser($username);

        if ( $user ) {
            $authn_user = $user[0];
            if (password_verify($password, $authn_user['password'])) {
                $_SESSION['user'] = $this->_helper->authnUser($authn_user);
                return null;
            } else {
                $alerta['title'] = 'Usuario o contraseña incorrectas.';
                $alerta['body']  = 'Favor de volver a intentar.';
                $alerta['type']  = 'warning';
            }
        } else {
            $alerta['title'] = 'Usuario no registrado';
            $alerta['body']  = 'No tienes acceso a la plataforma.';
            $alerta['type']  = 'error';
        }

        $this->_alerts->showAlert($alerta);
    }

    public function Redirect( )
    {
        ob_start(); 
        $file = ($_SESSION['user']['role_id'] == 2) ? "../User/contacts.php" : "../Admin/Dashboard.php";
        header("Location: {$file}");
        ob_end_flush();
        exit();
    }

    
}

?>