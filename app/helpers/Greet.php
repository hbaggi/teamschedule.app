<?php/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
 */

class Greet extends Model
{

    public function greeting($hora)
    {
        if($hora >= 0 && $hora < 6) {$greet = "Boa madrugada";}
        elseif ($hora >= 6 && $hora < 12) {$greet = "Bom dia";}
        elseif ($hora >= 12 && $hora < 18) {$greet = "Boa Tarde";}
        elseif ($hora >= 18 && $hora < 24) {$greet = "Boa noite";}

        $_SESSION['greet'] = $greet;

        return $greet;
    }

}