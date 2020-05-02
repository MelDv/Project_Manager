<?php

$db = parse_url(getenv("DATABASE_URL"));
$db["path"] = ltrim($db["path"], "/");

$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"], 1);


$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn' => '',
    'hostname' => $cleardb_server,
    'username' => $cleardb_username,
    'password' => $cleardb_password,
    'database' => $cleardb_db,
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

class DatabaseConfig
{

    private static $use_database = 'psql';
    private static $connection_config = array(
        'psql' => array(
            'resource' => 'pgsql:'
        ),
        'mysql' => array(
            'resource' => 'DB_PATH;DB_NAME',
            'username' => 'DB_USERNAME',
            'password' => 'DB_PASSWORD'
        )
    );

    public static function connection_config()
    {
        $config = array(
            'db' => self::$use_database,
            'config' => self::$connection_config[self::$use_database]
        );
        return $config;
    }

}
