<?php

class DB
{
    private $username = 'unset';

    public static function connection()
    {
        try {
            $connection = new PDO("pgsql:host=ec2-54-210-128-153.compute-1.amazonaws.com;dbname=dcnmle7k63eh3;user=svzldcojgyipsi;password=7bb6b2b5352e1dbf13a6a1a4781e4fe1b777b37ab73305147aa1c674685a80f5");
            // Asetetaan tietokannan kenttien koodaukseksi utf8
            $connection->exec('SET NAMES UTF8');

            // Näytetään virheilmoitukset
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        } catch (PDOException $e) {
            die('Virhe tietokantayhteydessä tai tietokantakyselyssä: ' . $e->getMessage());
        }

        return $connection;
    }

    public static function test_connection()
    {
        require 'vendor/ConnectionTest/connection_test.php';
        exit();
    }
}