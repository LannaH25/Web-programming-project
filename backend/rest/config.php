<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

class Config
{
    public static function DB_NAME() { return 'realestate'; }
    public static function DB_PORT() { return 3306; }
    public static function DB_USER() { return 'root'; }
    public static function DB_PASSWORD() { return ''; }
    public static function DB_HOST() { return '127.0.0.1'; }

    public static function JWT_SECRET() {
        return 'e1f9c7a4b23d8f14c9e6b2fa71d4e89a3f5c72bd8e1a9f34d6c1f5e8b7a2c49d';
    }
}
