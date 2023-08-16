<?php

require 'vendor/autoload.php';

use App\Controllers\InstallerController;

/**
 * Entry point of the installation process.
 */
function main() {
    $controller = new InstallerController();
    $installer = $controller->createInstaller();
    $installer->run();

    echo "Sikeres telepítés! Kattints ide: <a href='index.php'>Lista megtekintése</a>";
}

main();