<?php

class View
{

    public static function make($view, $content = array())
    {
        // Alustetaan Twig
        $twig = self::get_twig();

        try {
            // Asetetaan uudelleenohjauksen yhteydessä lisätty viesti
            self::set_flash_message($content);

            // Asetetaan näkymään base_path-muuttuja index.php:ssa määritellyllä BASE_PATH vakiolla
            $content['base_path'] = BASE_PATH;

            // Asetetaan näkymään kirjautunut käyttäjä, jos get_user_logged_in-metodi on toteutettu
            if (method_exists('BaseController', 'get_user_logged_in')) {
                $content['user_logged_in'] = BaseController::get_user_logged_in();
            }

            // Tulostetaan Twig:n renderöimä näkymä
            echo $twig->render($view, $content);
        } catch (Exception $e) {
            die('Virhe näkymän näyttämisessä: ' . $e->getMessage());
        }

        exit();
    }

    private static function get_twig()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/views');
        $twig = new\Twig\Environment($loader, ['debug' => true]);

        return new Twig_Environment($twig);
    }

    private static function set_flash_message(&$content)
    {
        if (isset($_SESSION['flash_message'])) {

            $flash = json_decode($_SESSION['flash_message']);

            foreach ($flash as $key => $value) {
                $content[$key] = $value;
            }

            unset($_SESSION['flash_message']);
        }
    }
}