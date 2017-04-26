<?php

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
