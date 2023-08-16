<?php

require 'vendor/autoload.php';

use App\Controllers\ProductsController;
use App\Models\ProductsModel;
use App\Models\DatabaseConnectionModel;

/**
 * Entry point of the application.
 */
function main() {
    $databaseConnection = new DatabaseConnectionModel();
    $databaseConnection->connect(); 
    $tableExists = $databaseConnection->getConnection()->query("SHOW TABLES LIKE 'monitors'")->rowCount() > 0;

    if (!$tableExists) {
        echo "Telepítéshez kattints ide: <a href='install.php'>Telepítés</a>";
    } else {
        $productController = new ProductsController($databaseConnection);
        $productController->listProducts($_GET['page'] ?? 1, 10);
    }
}

main();
