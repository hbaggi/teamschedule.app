<?php
/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
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
