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

class NotFoundController extends Controller
{
	public function index()
	{
		$data = array();
		$data['page'] = 'notfound';

		// ########################################################################

		$class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		// ########################################################################

		// $error_message = "Página não existe!";
		// $_SESSION['error_message'] = $error_message;

		$this->loadTemplate('notfound/index', $data);
	}
}
