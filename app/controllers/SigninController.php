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

class SigninController extends Controller
{
	public function index()
	{
		$data = array();
		$data['page'] = 'signin';

		// ########################################################################

		$class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		$class_auth = new Authentication();
		$class_auth->requireLogout();



		// $error_message = "E-mail não pode estar vazio!";
		// $_SESSION['error_message'] = $error_message;
		// header("Location: ".URL_PATH."signin");
		// exit;		

		// ########################################################################

		if (!isset($_SESSION['csrf_token'])) {
			$csrf_token = $class_auth->generateCsrfToken();
			$_SESSION['csrf_token'] = $csrf_token;
		}

		require_once(__DIR__ . '/receivers/signin.php');

		$this->loadTemplate('signin/index', $data);
	}
}
