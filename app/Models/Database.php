<?php

namespace App\Models;

use App\Helpers\Helpers;

use PDO;
use PDOException;

class Database
{

    private $_helper;
    private $dsn = '';
    private $username = '';
    private $password = '';
    private $conn;
    private $depuracion = true;

    public function __construct()
    {
        $file_env = dirname(__DIR__) . '/Core/settings.env';
        $this->_helper = new Helpers();
        $this->_helper->LoadEnv($file_env);
        $this->dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_DATABASE'] . ";charset=" . $_ENV['DB_CHARSET'] . ";";
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->depuracion = $_ENV['DB_DEBUG'];
    }

    function open()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$this->conn = new PDO($this->dsn, $this->username, $this->password);
            $this->conn->exec("set character set utf8");
        } catch (PDOException $e) {
            if ($this->depuracion)
                echo $e->getMessage();
            $this->conn = NULL;
            die();
        }
    }

    function CerrarConexion()
    {
        $this->conn = null;
    }

    function ConsultaPreparada($sql, $parametros)
    {
        if ($this->conn == NULL) {
            $this->open();
        }
        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute($parametros)) {
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Muestra el error de la consulta para ayudar a la depuración
            if ($this->depuracion) {
                echo "Error en la consulta: " . $sql . "\n";
                echo "Errores: " . var_dump($sentencia->errorInfo());
            }
            return null;
        }
    }

    public function ConsultaNormal($sql)
    {
        if ($this->conn == NULL)
            $this->open();
        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute()) {
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            if ($this->depuracion) {

                return FALSE;
            }
        }
    }

    public function normalInsertion($sql)
    {
        if ($this->conn == NULL)
            $this->open();
        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute()) {
            return TRUE;
        } else {
            if ($this->depuracion) {
                print_r($sentencia->errorInfo());
                exit;
                return FALSE;
            }
        }
    }

    public function InsertarRegistrosPreparada($sql, $parametros)
    {
        if ($this->conn == NULL)
            $this->open();
        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute($parametros)) {
            return TRUE;
        } else {
            if ($this->depuracion) {
                echo var_dump($sentencia->errorInfo());
                exit;
                return FALSE;
            }
        }
    }


    public function InsertPreparedAndReturnID($sql, $parametros)
    {
        if ($this->conn == NULL)
            $this->open();

        try {
            $sentencia = $this->conn->prepare($sql);
            if ($sentencia->execute($parametros)) {
                // Retorna el último ID insertado si la consulta fue exitosa
                return $this->conn->lastInsertId();
            } else {
                // Si la ejecución falló, retornar FALSE
                return FALSE;
            }
        } catch (PDOException $e) {
            // Si ocurre un error, y está habilitada la depuración, mostrar el error
            if ($this->depuracion) {
                echo "Error en la inserción: " . $e->getMessage();
            }
            return FALSE;
        }
    }


    public function ModificarRegistrosPreparada($sql, $parametros)
    {

        if ($this->conn == NULL)
            $this->open();

        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute($parametros)) {
            return TRUE;
        } else {
            if ($this->depuracion) {
                echo var_dump($sentencia->errorInfo());
                exit;
                return FALSE;
            }
        }
    }

    public function EliminarRegistrosPreparada($sql, $parametros)
    {

        if ($this->conn == NULL)
            $this->open();
        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute($parametros)) {
            return TRUE;
        } else {
            if ($this->depuracion) {
                return FALSE;
            }
        }
    }

    function ConsultaAsociativaOrdenada($tabla, $filtro, $orden, $parametros)
    {
        if ($this->conn == NULL)
            $this->open();
        $sentencia = $this->conn->prepare("SELECT * FROM " . $tabla . " where " . $filtro . "ORDER BY " . $orden);
        if ($sentencia->execute($parametros)) {
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            if ($this->depuracion)
                echo var_dump($sentencia->errorInfo());
            return null;
        }
    }


    public function Multiple_transaction($queries)
    {
        if ($this->conn == NULL)
            $this->open();

        try {
            // Iniciar la transacción
            $this->conn->beginTransaction();

            // Ejecutar las consultas
            foreach ($queries as $query) {
                $sql = $query['sql'];
                $parametros = $query['parametros'];

                $sentencia = $this->conn->prepare($sql);
                if (!$sentencia->execute($parametros)) {
                    // Si falla alguna consulta, lanzar una excepción para revertir la transacción
                    throw new PDOException("Error ejecutando consulta: " . $sql);
                }
            }

            // Si todas las consultas fueron exitosas, confirmar la transacción
            $this->conn->commit();

            return TRUE;
        } catch (PDOException $e) {
            // Si hubo un error, revertir la transacción
            $this->conn->rollBack();

            if ($this->depuracion) {
                echo "Error en la transacción: " . $e->getMessage();
            }

            return FALSE;
        }
    }
}
