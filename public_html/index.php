<?php
/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
 */

require_once(__DIR__ . '/config/config.php');
require_once(__DIR__ . '/../app/init.php');

//if(session_id()){echo "SESSION_ID: ".session_id()."<br>";}
//if(isset($_SESSION['csrf_token'])){echo "CSRF_TOKEN SESSION: ".$_SESSION['csrf_token']."<br>";}
//if(isset($_SESSION['token'])){echo "TOKEN SESSION: ".$_SESSION['token']."<br>";}

$core = new Core();
