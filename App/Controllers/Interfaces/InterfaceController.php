<?php

namespace App\Controllers\Interfaces;
use App\Classes\AbstractInstaller;

/**
 * Interface for installer controllers.
 */
interface InterfaceController {
    /**
     * Create an installer instance.
     *
     * @return Installer The created installer instance.
     */
    public function createInstaller(): AbstractInstaller;
}