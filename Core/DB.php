<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 19/07/2016
 * Time: 16:50
 */

namespace Core;


class DB
{
    public static function getPDO()
    {
        $driver =  getenv('DB_DRIVER') ?: 'mysql';
        $dbname = getenv('DB_NAME') ?: 'simpleblog';
        $host = getenv('DB_HOST') ?: 'localhost';
        $user = getenv('DB_USER') ?: 'simpleblog';
        $password = getenv('DB_PASSWORD') ?: 'password';

        $pdo = new \PDO(
            "$driver:host=$host;dbname=$dbname;charset=utf8",
            $user,
            $password
        );

        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

}