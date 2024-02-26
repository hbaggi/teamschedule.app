<?php
/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
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
