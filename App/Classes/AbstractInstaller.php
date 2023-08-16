<?php

namespace App\Classes;

use App\Models\DatabaseConnectionModel;

/**
 * Abstract class representing an installer.
 */
abstract class AbstractInstaller {
    /**
     * @var DatabaseConnectionModel The database connection instance.
     */
    protected $databaseConnection;

    /**
     * Installer constructor.
     *
     * @param DatabaseConnectionModel $databaseConnection The database connection instance.
     */
    public function __construct(DatabaseConnectionModel $databaseConnection) {
        $this->databaseConnection = $databaseConnection;
    }

    /**
     * Abstract method to run the installer.
     */
    abstract public function run();
}
