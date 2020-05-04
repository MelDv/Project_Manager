<?php

class DatabaseConfig
{

    public static function connection_config()
    {
        $config = array(
            'config' => array(
                'port' => '5432',
                'host' => 'ec2-54-210-128-153.compute-1.amazonaws.com',
                'dbname' => 'dcnmle7k63eh3',
                'user' => 'svzldcojgyipsi',
                'password' => '7bb6b2b5352e1dbf13a6a1a4781e4fe1b777b37ab73305147aa1c674685a80f5',
                'sslmode' => 'require'
            )
        );
        return $config;
    }
}

//$con = "dbname=fgsfg10pdq host=ghfghfh4654.amazonaws.com port=5432 user=gafasduyiu password=435346af8493196 sslmode=require";
