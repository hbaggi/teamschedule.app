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

require_once(__DIR__ . '/config/config.php');
require_once(__DIR__ . '/../app/init.php');

//if(session_id()){echo "SESSION_ID: ".session_id()."<br>";}
//if(isset($_SESSION['csrf_token'])){echo "CSRF_TOKEN SESSION: ".$_SESSION['csrf_token']."<br>";}
//if(isset($_SESSION['token'])){echo "TOKEN SESSION: ".$_SESSION['token']."<br>";}

$core = new Core();
