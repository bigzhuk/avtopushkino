<?php

/**
 * Подключаем базу данных. Будем работать через PDO.
 * @property PDO db
 * @property string dsn
 * @property string user
 * @property string password
 */
class Db_connect {
    private static $dsn = 'mysql:dbname=auto;host=localhost';
    private static $user = 'auto';
    private static $password = 'admin';
    private static $db = null;

    private function __construct(){

    }

    private static function connect() {
        setlocale(LC_ALL, 'ru_RU');
        try {
            self::$db = new PDO(self::$dsn, self::$user, self::$password);
            self::$db->exec("SET NAMES UTF8");
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }

    public static function gI() {
        if (null === self::$db) {
            self::connect();
        }
        // возвращаем созданный или существующий экземпляр
        return self::$db;
    }

}
$db = Db_connect::gI();



