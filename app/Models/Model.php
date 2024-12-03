<?php

namespace App\Models;

use App\Models\Database;

class Model extends DataBase
{

    // Consultas
    public function SearchUser($username)
    {
        return $this->ConsultaPreparada("SELECT * FROM users WHERE username = ? AND status = ?", [$username, 'ACTIVE']);
    }

    public function SearchUserByUsername($username)
    {
        $user = $this->ConsultaPreparada("SELECT * FROM users WHERE email = ?", [$username]);
        return $user;
    }

    public function FindUserByUsername($username)
    {
        $dato = $this->ConsultaPreparada("SELECT * FROM users WHERE username = ?", [ $username ] ); 
        return $dato;
    }

    public function InsertUserDataBase($datos)
    {
        $estado = $this->InsertarRegistrosPreparada("INSERT INTO users (username, password, role_id, status) VALUES (?,?,?,?)",$datos);
        return $estado;
    }

    public function AddUser($user, $profile)
    {
        $request = $this->InsertarRegistrosPreparada("INSERT INTO users (role_id, email, password, first_names, last_names, status) VALUES (?,?,?,?,?,?)", $user);
        return $request;
    }

    public function AddSalesAgent($user, $profile, $agent)
    {
        $request = $this->InsertarRegistrosPreparada("INSERT INTO users (role_id, email, password, first_names, last_names, status) VALUES (?,?,?,?,?,?)", $user);
        return $request;
    }

    public function GetPropertiesByType($parameters)
    {

        $estado = $this->ConsultaPreparada(
            "SELECT
                p.id AS property_id,
                p.title,
                p.description,
                CONCAT(p.address, ', ', p.city, ', ', p.state, ', ', p.zip_code, ', ', p.country) AS full_address,
                p.price,
                p.bedrooms,
                p.bathrooms,
                p.square_feet,
                p.lot_size,
                p.property_type,
                p.year_built,
                p.listing_date,
                p.status,
                GROUP_CONCAT(DISTINCT pf.feature_name ORDER BY pf.feature_name ASC SEPARATOR ', ') AS features,
                GROUP_CONCAT(DISTINCT pi.image_url ORDER BY pi.is_primary DESC, pi.id ASC SEPARATOR ', ') AS images
            FROM
                properties p
            LEFT JOIN
                property_features pf ON p.id = pf.property_id
            LEFT JOIN
                property_images pi ON p.id = pi.property_id
            LEFT JOIN
                property_agents pa ON p.id = pa.property_id
            WHERE 
                p.property_type = ?
            GROUP BY
                p.id",
            $parameters
        );
        return $estado;
    }
}
