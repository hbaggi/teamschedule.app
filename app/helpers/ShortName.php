<?php
/**
 * Projeto Agenda PHP PDO MVC.
 *
 * @author Lázaro Baggi
 * @copyright CTI SAEB - SECRETARIA DA ADMINISTRAÇÃO All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.git
 * 
 * 
 */

class ShortName extends Model
{

    public function firstNameLastName($name)
    {
        $name = explode(" ", $name);
        $firstName = array_shift($name);
        $lastName = array_pop($name);
        $name = $firstName." ".$lastName;

        $_SESSION['short_name'] = $name;

        return $name;

    }

}