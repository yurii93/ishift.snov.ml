<?php

namespace Controller;

use Model\LiqPayModel;

class BaseController
{
    protected $name = 'index';

    protected $data;

    protected $message;


    /*
     * Renders pages
     */
    protected function render($templateName)
    {
        $data = $this->data;
        $message = $this->message;

        include SITE_DIR . DS . "View" . DS . $this->name . DS . $templateName . '.php';
    }

    /*
     * Checks if it is admin
     */
    protected function isAdmin()
    {
        if (!isset($_SESSION['admin']) || $_SESSION['adminRole'] != 'admin') {
            header('Location: /');
            die;
        }
    }

    /*
     * Checks if certain http_referrer is set
     */
    protected function refer($string, $link)
    {
        if (!isset($_SERVER['HTTP_REFERER']) || !strpos($_SERVER['HTTP_REFERER'], $string)) {
            header("Location: {$link}");
            die();
        }
    }

    /*
     * Checks if any http_referrer is set
     */
    protected function hasReferrer()
    {
        if (!isset($_SERVER['HTTP_REFERER'])) {
            header('Location: /');
        }
    }

    /*
     * Checks and shows information in the inputs
     */
    public static function info($name)
    {
        if (isset($_SESSION['info'][$name])) {
            echo $_SESSION['info'][$name];
        }
    }
}