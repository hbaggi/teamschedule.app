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

class HomeController extends Controller
{
	public function index()
	{
		$data = array();
		$data['page'] = 'home';

		// ########################################################################

		$class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		// ########################################################################

		// SEM PÁGINA PRINCIPAL (HOME), ABRE DIRETO NO LOGIN HB-05-02-24
		header("Location: " . URL_PATH . "signin");

		$this->loadTemplate('home/index', $data);
	}
}
