<?php
/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
 */

class VerifyController extends Controller
{
	public function index()
	{
		$data = array();
		$data['page'] = 'verify';

		// ########################################################################

		$class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		$user_id = $_SESSION['user_id'];
		$class_user = new User();
		$data['user'] = $class_user->getUser($user_id);

		// ########################################################################

		require_once(__DIR__ . '/receivers/verify.php');

		$this->loadTemplate('verify/index', $data);
	}
}
