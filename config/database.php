<?php



class DatabaseConfig
{

    private static $use_database = 'psql';
    private static $connection_config = array(
        'psql' => array(
            'resource' => 'pgsql:'
        ),
        'mysql' => array(
            'resource' => 'postgres://svzldcojgyipsi:7bb6b2b5352e1dbf13a6a1a4781e4fe1b777b37ab73305147aa1c674685a80f5@ec2-54-210-128-153.compute-1.amazonaws.com:5432/dcnmle7k63eh3;dcnmle7k63eh3',
            'username' => 'svzldcojgyipsi',
            'password' => '7bb6b2b5352e1dbf13a6a1a4781e4fe1b777b37ab73305147aa1c674685a80f5'
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
