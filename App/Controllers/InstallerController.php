<?php

namespace App\Controllers;

use App\Models\DatabaseConnectionModel;
use App\Controllers\Interfaces\InterfaceController;
use App\Classes\AbstractInstaller;
use App\Classes\Install;
use Exception;

/**
 * Class responsible for creating installer instances.
 */
class InstallerController implements InterfaceController {
    /**
     * Create an installer instance.
     *
     * @return Installer The created installer instance.
     */
    public function createInstaller(): AbstractInstaller {
        try {
            $dbConnection = new DatabaseConnectionModel();
            $dbConnection->connect();

            return new Install($dbConnection);

            $dbConnection->closeConnection();
        } catch (Exception $e) {
            echo "Hiba: " . $e->getMessage();
        }
    }
}
