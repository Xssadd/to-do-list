<?php
namespace App;

use PDO;
use PDOException;
use RuntimeException;

class Database
{
    private static $instance = null;

    private const DB_HOST = 'todolist_mysql';
    private const DB_NAME= 'todolist';
    private const DB_USER= 'root';
    private const DB_PASS= 'root';

    private function __construct() {}

    public static function getConnection(): PDO {
        if (!isset(self::$instance)) {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=utf8mb4',
                self::DB_HOST,
                self::DB_NAME
            );

            try {
                self::$instance = new PDO($dsn,self::DB_USER, self::DB_PASS,[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            }
            catch (PDOException $e) {
                throw new RuntimeException('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}