<?php/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
 */

class SettingsController extends Controller 
{
	public function index()	
	{
		$data = array();
		$data['page'] = 'settings';
		$user_id = $_SESSION['user_id'];

		// ########################################################################

	    $class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		$class_auth = new Authentication();
		$class_auth->requireLoggedInAndVerified();

		$class_user = new User();
		$data['user'] = $class_user->getUser($user_id);

		// ########################################################################
		
		$this->loadTemplate('admin/settings/index', $data);
	}
}

