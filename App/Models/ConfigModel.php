<?php

namespace App\Models;

/**
 * Class Config
 *
 * Configuration handler.
 */
class ConfigModel {
    /**
     * @var array Configuration data.
     */
    private $data;

    /**
     * Config constructor.
     */
    public function __construct() {
        $this->data = parse_ini_file(__DIR__ . '/../../config.env');
    }

    /**
     * Get configuration value by key.
     *
     * @param string $key The configuration key.
     * @return mixed|null The configuration value if exists, otherwise null.
     */
    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
}
