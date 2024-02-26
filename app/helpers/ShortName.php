<?php/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
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