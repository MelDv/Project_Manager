<?php

$db = parse_url(getenv("DATABASE_URL"));
$db["path"] = ltrim($db["path"], "/");

class DatabaseConfig {

    private static $use_database = 'psql';
    private static $connection_config = array(
        'psql' => array(
            'resource' => 'pgsql:'
        ),
        'mysql' => array(
            'resource' => 'mysql:unix_socket=/home/KAYTTAJATUNNUS/mysql/socket;dbname=mysql',
            'username' => 'root',
            'password' => 'SALASANA'
        )
    );

    public static function connection_config() {
        $config = array(
            'db' => self::$use_database,
            'config' => self::$connection_config[self::$use_database]
        );
        return $config;
    }

}

$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"], 1);
