<?php

namespace App\Models;

/**
 * Class InstallModel
 *
 * Model for installation and database operations.
 */
class InstallModel {

    /**
     * @var \PDO The database connection.
     */
    private $connection;

    /**
     * InstallModel constructor.
     *
     * @param \PDO $pdo The PDO instance.
     */
    public function __construct(\PDO $pdo) {
        $this->connection = $pdo;
    }

    /**
     * Seed tables with data.
     *
     * @param array $data The data to seed.
     */
    public function seedTables(array $data) {
        $this->seedMonitorsTable($data);
    }

    /**
     * Create necessary tables.
     */
    public function createTables() {
        $this->createMonitorsTable();
    }

    /**
     * Create monitors table.
     */
    private function createMonitorsTable() {
        $query = "
            CREATE TABLE IF NOT EXISTS monitors (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                description TEXT,
                base_price DECIMAL(10, 2),
                discount_price DECIMAL(10, 2),
                brand VARCHAR(50),
                screen_size DECIMAL(5, 2),
                resolution VARCHAR(20)
            )
        ";

        $this->connection->exec($query);
    }

    /**
     * Seed monitors table with data.
     *
     * @param array $data The data to seed.
     */
    private function seedMonitorsTable(array $data) {
        foreach ($data as $monitor) {
            $query = "
                INSERT INTO monitors (name, description, base_price, discount_price, brand, screen_size, resolution)
                VALUES ('" . $monitor['name'] . "', '" . $monitor['description'] . "', " . $monitor['basePrice'] . ", " . $monitor['discountPrice'] . ", '" . $monitor['brand'] . "', '" . $monitor['screenSize'] . "', '" . $monitor['resolution'] . "')
            ";

            $this->connection->exec($query);
        }
    }
}
