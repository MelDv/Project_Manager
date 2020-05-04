<?php
$db = parse_url(getenv("DATABASE_URL"));
$db["path"] = ltrim($db["path"], "/");

$active_group = 'default';
$query_builder = TRUE;

class DB
{
    public static function connection()
    {
        // Haetaan tietokantakonfiguraatio
        $connection_config = DatabaseConfig::connection_config();
        $config = $connection_config['mysql'];

        try {
            // Alustetaan PDO
            if (isset($config['username'])) {
                $connection = new PDO($config['port'], $config['host'], $config['dbname'], $config['username'], $config['password'], $config['sslmode']);
            } else {
                $connection = new PDO($config['port']);
            }
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