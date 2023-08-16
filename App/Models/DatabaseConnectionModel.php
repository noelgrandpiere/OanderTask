<?php

namespace App\Models;

use App\Models\ConfigModel;

/**
 * Class DatabaseConnectionModel
 *
 * Model for handling database connections.
 */
class DatabaseConnectionModel {
    /**
     * @var string Database host.
     */
    private $host;

    /**
     * @var int Database port.
     */
    private $port;

    /**
     * @var string Database name.
     */
    private $dbname;

    /**
     * @var string Database username.
     */
    private $username;

    /**
     * @var string Database password.
     */
    private $password;

    /**
     * @var \PDO|null Database connection instance.
     */
    private $connection;

    /**
     * DatabaseConnectionModel constructor.
     */
    public function __construct() {
        $config = new ConfigModel();

        $this->host = $config->get('DB_HOST');
        $this->port = $config->get('DB_PORT');
        $this->dbname = $config->get('DB_NAME');
        $this->username = $config->get('DB_USER');
        $this->password = $config->get('DB_PASS');
    }

    /**
     * Establish a database connection.
     *
     * @throws \Exception If connection is unsuccessful.
     */
    public function connect() {
        try {
            $this->connection = new \PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception("Kapcsolat sikertelen: " . $e->getMessage());
        }
    }

    /**
     * Get the database connection instance.
     *
     * @return \PDO|null The database connection instance.
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * Close the database connection.
     */
    public function closeConnection() {
        $this->connection = null;
    }
}
