<?php 
namespace App\Controllers;

use App\Models\Model;
use App\Helpers\Alerts;

class Registers 
{
    private $_model;
    private $_alerts;

    
    function __construct(){
        $this->_model = new Model();
        $this->_alerts = new Alerts();
    }


    public function AddUser(){

        $alert = ['title' => '', 'body' => '', 'type' => '', 'location' => ''];
        if ( isset($_POST['username']) && isset($_POST['password']) ) {
            $result     = $this->_model->FindUserByUsername($_POST['username']);
            if (empty($result)) {
                $password       = password_hash($_POST['password'], PASSWORD_ARGON2I); // pasar la contraseña a un hash
                $resultInsert   = $this->_model->InsertUserDataBase([$_POST['username'], $password,2, 'ACTIVE']);
                if ($resultInsert == true) {
                    $alert['title']     = 'Registro exitoso';
                    $alert['body']      = 'Ya puedes ingresar a la platafroma';
                    $alert['type']      = 'success';
                    $alert['location']  = 'login.php';
                }
            } else {
                $alert['title'] = 'ERROR';
                $alert['body']  = 'El correro ya esta registrado';
                $alert['type']  = 'error';
            }
            $this->_alerts->showAlert($alert);
        }
    }

  

}
?>