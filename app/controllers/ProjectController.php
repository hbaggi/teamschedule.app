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

class ProjectController extends Controller 
{
	public function index()	
	{
		$data = array();
		$data['page'] = 'project';
		
		// ########################################################################

	    $class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		$class_auth = new Authentication();
		$class_auth->requireLoggedInAndVerified();

		$user_id = $_SESSION['user_id'];
		$class_user = new User();
		$data['user'] = $class_user->getUser($user_id);

		// ########################################################################

		$class_project = new Project();
		$data['projects'] = $class_project->getProjectsByUserId($user_id);

		$data['totalEnabled'] = $class_project->getAllProjectsIsEnabledByUserID($user_id);
		$data['totalDisabled'] = $class_project->getAllProjectsIsDisabledByUserID($user_id);

		$class_slug_convert = new SlugConvert();

    	require_once(__DIR__.'/receivers/project-create.php');
    	require_once(__DIR__.'/receivers/project-enabled.php');
    	require_once(__DIR__.'/receivers/project-edit.php');
    	require_once(__DIR__.'/receivers/project-delete.php');		

		$this->loadTemplate('project/index', $data);
	}

	public function edit()	
	{
		$data = array();
		$page = 'edit';
		$user_id = $_SESSION['user_id'];
		$link_id = $_SESSION['link_id'];
		$project_id = $_SESSION['project_id'];		

	    $class_settings = new Settings();
		$data['setting'] = $class_settings->getSettings();

		$class_language = new Languages();
		$data['language'] = $class_language->getLanguage();

		$class_auth = new Authentication();
		$class_auth->requireLoggedInAndVerified();

		$class_user = new User();
		$data['user'] = $class_user->getUser($user_id);

		$class_link = new Link();
		$data['link'] = $class_link->getLinkJoinsAllTablesByLinkId($link_id);
		$data['links'] = $class_link->getLinksJoinDomainsByUserId($user_id);

		$class_project = new Project();
		$data['project'] = $class_project->getProjectByProjectId($project_id);

		$class_slug_convert = new SlugConvert();

		require_once(__DIR__.'/receivers/project-update.php');
    	//require_once(__DIR__.'/receivers/pixel-delete.php');

		$this->loadTemplate('project/edit', $data);
	}

}


