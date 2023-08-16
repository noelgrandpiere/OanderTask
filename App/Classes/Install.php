<?php

namespace App\Classes;

use App\Models\InstallModel;
use App\Models\DatabaseConnectionModel;
use Exception;

/**
 * Class representing the installation process.
 */
class Install extends AbstractInstaller {
    /**
     * Install constructor.
     *
     * @param DatabaseConnectionModel $databaseConnection The database connection instance.
     */
    public function __construct(DatabaseConnectionModel $databaseConnection) {
        parent::__construct($databaseConnection);
    }

    /**
     * Run the installation process.
     */
    public function run() {
        try {
            $tableCreator = new InstallModel($this->databaseConnection->getConnection());
            $tableCreator->createTables();

            $numMonitors = 50;
            $brands = ['Samsung', 'LG', 'Technika', 'Sencor', 'Hp', 'Hitachi', 'Oander', 'E-commerce'];
            $resolutions = ['1920x1080', '2560x1440', '3840x2160'];
            $monitors = array();

            for ($i = 0; $i < $numMonitors; $i++) {
                array_push($monitors, [
                    "name" => "$i monitor",
                    "description" => "Tetszőleges valami leírás a monitorhoz $i",
                    "basePrice" => rand(10000, 50000),
                    "discountPrice" => rand(10000, 50000),
                    "brand" => $brands[array_rand($brands)],
                    "screenSize" => rand(20, 32) + (rand(0, 9) / 10),
                    "resolution" => $resolutions[array_rand($resolutions)]
                ]);
            }
            $tableCreator->seedTables($monitors);
        } catch (Exception $e) {
            echo "Hiba: " . $e->getMessage();
        }
    }
}