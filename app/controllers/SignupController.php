<?php

/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BTECH. All rights reserved.
 * @link http://baggitech.com.br
 */

class SignupController extends Controller
{
	// START - PAGE SIGNUP
	public function index()
	{
		$data = array();
		$data['page'] = 'signup';
		$_SESSION['user_id'] = '';

		// ########################################################################

		$class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		$class_auth = new Authentication();
		$class_auth->requireLogout();

		$user_id = $_SESSION['user_id'];
		$class_user = new User();
		$data['user'] = $class_user->getUser($user_id);

		// ########################################################################

		$class_email_active_link = new EmailManager();

		if (!isset($_SESSION['csrf_token'])) {
			$csrf_token = $class_auth->generateCsrfToken();
			$_SESSION['csrf_token'] = $csrf_token;
		}

		$class_code_generate = new CodeGenerate();
		$data['captcha_code'] = $class_code_generate->generatingCode(6, false, true, true, false);
		$_SESSION['captcha_code'] = $data['captcha_code'];

		require_once(__DIR__ . '/receivers/signup.php');

		$this->loadTemplate('signup/index', $data);
	}
	// END PAGE SIGNUP
}
