<?php
/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
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
