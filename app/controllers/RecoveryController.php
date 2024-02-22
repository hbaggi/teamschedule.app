<?php

/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BTECH. All rights reserved.
 * @link http://baggitech.com.br
 */

class RecoveryController extends Controller
{
	public function index()
	{
		$data = array();
		$data['page'] = 'recovery';

		// ########################################################################

		$class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		$class_auth = new Authentication();
		$class_auth->requireLogout();

		//$user_id = $_SESSION['user_id'];
		//$class_user = new User();
		//$data['user'] = $class_user->getUser($user_id);

		// ########################################################################

		if (!isset($_SESSION['csrf_token'])) {
			$csrf_token = $class_auth->generateCsrfToken();
			$_SESSION['csrf_token'] = $csrf_token;
		}

		$class_recovery = new Recovery();

		$class_email_recovery_link = new EmailManager();

		require_once(__DIR__ . '/receivers/recovery.php');

		$this->loadTemplate('recovery/index', $data);
	}

	public function password()
	{
		$data = array();
		$data['page'] = 'password';

		// ########################################################################

		$class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		$class_auth = new Authentication();
		//$class_auth->requireNoVerified();

		//$user_id = $_SESSION['user_id'];
		$class_user = new User();
		//$data['user'] = $class_user->getUser($user_id);

		// ########################################################################

		if (!isset($_SESSION['csrf_token'])) {
			$csrf_token = $class_auth->generateCsrfToken();
			$_SESSION['csrf_token'] = $csrf_token;
		}

		$class_recovery = new Recovery();

		require_once(__DIR__ . '/receivers/recovery-token.php');
		require_once(__DIR__ . '/receivers/recovery-password.php');

		$this->loadTemplate('recovery/password', $data);
	}

	public function requested()
	{
		$data = array();
		$data['page'] = 'requested';

		// ########################################################################

		$class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		$class_auth = new Authentication();
		$class_auth->requireLoggedInAndVerified();

		//$user_id = $_SESSION['user_id'];
		//$class_user = new User();
		//$data['user'] = $class_user->getUser($user_id);

		// ########################################################################

		$this->loadTemplate('recovery/requested', $data);
	}

	public function changed()
	{
		$data = array();
		$data['page'] = 'changed';

		// ########################################################################

		$class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		$class_auth = new Authentication();
		$class_auth->requireLogout();

		//$user_id = $_SESSION['user_id'];
		//$class_user = new User();
		//$data['user'] = $class_user->getUser($user_id);

		// ########################################################################

		$this->loadTemplate('recovery/changed', $data);
	}
}
