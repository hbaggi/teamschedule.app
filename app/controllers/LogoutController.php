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

class LogoutController extends Controller
{
	public function index()
	{
		$data = array();
		$data['page'] = 'logout';

		// ########################################################################

		$class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		// ########################################################################

		$error_message = "Você saiu!";
		$_SESSION['error_message'] = $error_message;
		session_destroy();

		header("Location: " . URL_PATH . "./");
	}
}
