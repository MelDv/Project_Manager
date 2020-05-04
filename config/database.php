
<?php

class DatabaseConfig {

    private static $use_database = 'psql';
    private static $connection_config = array(
        'psql' => array(
            'port' => 'pgsql:'
        ),
        'mysql' => array(
            'port' => 5432,
            'host'=> 'ec2-54-210-128-153.compute-1.amazonaws.com',
            'dbname' => 'svzldcojgyipsi',
            'username' => 'svzldcojgyipsi',
            'password' => '7bb6b2b5352e1dbf13a6a1a4781e4fe1b777b37ab73305147aa1c674685a80f5',
            'sslmode' => 'require'
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
//$con = "dbname=fgsfg10pdq host=ghfghfh4654.amazonaws.com port=5432 user=gafasduyiu password=435346af8493196 sslmode=require";
