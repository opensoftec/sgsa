<?php

class DataConection extends PDO {

    protected static $instancia;

    public static function getInstancia() {
        if (empty(self::$instancia)) {
            self::$instancia = new self();
            self::$instancia->exec('SET NAMES utf8');
        }
        return self::$instancia;
    }

    public function __construct($bdtipo = 'mysql') {
        switch ($bdtipo) {
            case 'postgres':
                $dns = 'pgsql:host=' . DB_HOST . ' dbname=' . DB_BASE . ' charset=UTF-8';
                break;
            default:
                $dns = 'mysql:host=' . DB_HOST . ';dbname=' . DB_BASE;
                break;
        }
        parent::__construct($dns, DB_USER, DB_PASS, array(
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                )
        );
    }

    public function __destruct() {
        self::$instancia = null;
    }

}
