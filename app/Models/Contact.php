<?php

namespace App\Models;

use App\Models\Database;


class Contact extends Database
{
  // Insertar datos del formulario a la Base de datos 
  public function InsertContact($datos)
  {
    $contact = $this->InsertPreparedAndReturnID("INSERT INTO contacts (names, last_names, phone_number, email, birth_date, company, position, category,notes, profile_picture, user_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)", $datos);
    return $contact;
  }
  // Insertar la dirección del contacto y lo relaciona a el contacto 
  public function InsertContactAddress($datos)
  {
    $address = $this->InsertPreparedAndReturnID("INSERT INTO contact_addresses (contact_id, street, number_ext, number_int, neighborhood, city, state, postal_code, address_type ) VALUES (?,?,?,?,?,?,?,?,?)", $datos);
    return $address;
  }

  public function GetContact($user_id)
  {
    $contacts = $this->ConsultaPreparada("SELECT contacts.names , contacts.last_names, contacts.phone_number, contacts.email, contacts.birth_date, contacts.company, contacts.position, contacts.category, contacts.notes, contacts.profile_picture, 
    CONCAT_WS(' ', 'Calle', contact_addresses.street, 'No. Ext', contact_addresses.number_ext, 'No. Int', contact_addresses.number_int, 'Col.', contact_addresses.neighborhood, 'C.P', contact_addresses.postal_code, 'Cuidad', contact_addresses.city, ',', contact_addresses.state ) AS 'Full_Address' 
    FROM contacts 
    INNER JOIN contact_addresses ON contacts.id = contact_addresses.contact_id 
    WHERE contacts.user_id= ?",$user_id);
    return $contacts;
  }
}
