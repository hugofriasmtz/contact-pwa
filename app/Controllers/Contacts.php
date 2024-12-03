<?php

namespace App\Controllers;

use App\Models\Contact;
use App\Helpers\Alerts;
use App\Helpers\Helpers;
use App\Helpers\Images;


class Contacts
{
    private $_contact;
    private $_alerts;
    private $_helper;
    private $_images;


    function __construct()
    {
        $this->_contact = new Contact();
        $this->_alerts = new Alerts();
        $this->_helper = new Helpers();
        $this->_images = new Images();
    }

    public function AddContact($user_id)
    {
        $alert = ['title' => '', 'body' => '', 'type' => '', 'location' => ''];

        if (isset($_POST['names']) && isset($_POST['last_names']) && 
            isset($_POST['phone_number']) && isset($_POST['email'])
                && isset($_POST['birth_date'])  && isset($_POST['category'])
                && isset($_POST['company']) && isset($_POST['position'])
                && isset($_POST['category']) && isset($_POST['notes'])
                && isset($_POST['street']) && isset($_POST['number_ext']) 
                && isset($_POST['number_int']) && isset($_POST['neighborhood']) 
                && isset($_POST['city']) && isset($_POST['state']) 
                && isset($_POST['postal_code']) && isset($_POST['address_type']))
            {

                $validated = $this->_images->Validated($_FILES['profile_picture']);
                if (!$validated['valid']) {
                    $alert['title'] = 'Error';
                    $alert['body'] = $validated['error'];
                    $alert['type'] = 'error';
                }

                $upload = $this->_images->UploadFile($_FILES['profile_picture']);
                if (!$upload['valid']) {
                    $alert['title'] = 'Error';
                    $alert['body'] = $upload['error'];
                    $alert['type'] = 'error';
                }

                $values_contacts = [
                    $_POST['names'],      $_POST['last_names'], $_POST['phone_number'], $_POST['email'],
                    $_POST['birth_date'], $_POST['company'],    $_POST['position'], $_POST['category'],
                    $_POST['notes'],$upload['img'],         $user_id
                ];
                $id_contact = $this->_contact->InsertContact($values_contacts);

                $values_address = [
                    $id_contact,            $_POST['street'], $_POST['number_ext'],  $_POST['number_int'],  
                    $_POST['neighborhood'], $_POST['city'],   $_POST['state'],       $_POST['postal_code'], 
                    $_POST['address_type']
                ];
                $contac_address = $this->_contact->InsertContactAddress($values_address);
                $alert['title'] = 'Registro exitoso';
                $alert['body'] = 'Contacto registrado';
                $alert['type'] = 'success';
                $alert['location'] = '';
            }
        $this->_alerts->showAlert($alert);
    }

    public function GetContacts($user_id){

        $playload = "";
        $cardContact = $this->_contact->GetContact($user_id);
        foreach ($cardContact as $contact) {
            $category_contact ="";
            switch($contact['category']) {
                case 'PERSONAL';  $category_contact = 'Personal';   break;
                case 'WORK';      $category_contact = 'Trabajo';    break;
                case 'FRIEND';    $category_contact = 'Amigo';      break;
                case 'HOME';      $category_contact = 'Casa';       break;
                case 'OFFICE';    $category_contact = 'Oficina';    break;
            
            }

            $address_type = "";
            switch ($address_type=['address_type']) {
                case 'HOUSE':      $address_type = 'Casa';        break;
                case 'APARTMENT':  $address_type = 'Apartamento'; break;
                case 'STUDY':      $address_type = 'Estudio';     break;
                case 'BUSINESS':   $address_type = 'Trabajo';     break;

            }

            $playload .='' ;
        }
        return $playload;
    }
   

}
