<?php
if(isset($_POST['form_project_enabled_1']))
{
    // Verifica se o token CSRF é válido
    if (!isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) 
    {
        $error_message = "Token inválido. Tente novamente.";
        $_SESSION['error_message'] = $error_message;
        header("Location: " . URL_PATH . "project");
        exit;
    }
    else
    {
		$project_id = filter_input(INPUT_POST, 'project_id', FILTER_SANITIZE_NUMBER_INT);
		$project_is_enabled = filter_input(INPUT_POST, 'project_is_enabled', FILTER_VALIDATE_INT);

		if($project_is_enabled == null || $project_is_enabled == 0)
		{	
			$project_is_enabled = 0;

			if($class_project->setEnabledProject($user_id, $project_id, $project_is_enabled))
			{
			   	$error_message = "Projeto desativado!";
			   	$_SESSION['error_message'] = $error_message;
		    	header("Location: " . URL_PATH . "project");
		    	exit;
			}
		}
	    else
	    {
			if($class_project->setEnabledProject($user_id, $project_id, $project_is_enabled))
			{
			    $success_message = "Projeto ativado!";
			    $_SESSION['success_message'] = $success_message;
		    	header("Location: " . URL_PATH . "project");
		    	exit;
			}	    			
	    }
	}
}

if(isset($_POST['form_project_enabled_2']))
{
    // Verifica se o token CSRF é válido
    if (!isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) 
    {
        $error_message = "Token inválido. Tente novamente.";
        $_SESSION['error_message'] = $error_message;
        header("Location: " . URL_PATH . "project/edit/" . $project_id);
        exit;
    }
    else
    {
		$project_id = filter_input(INPUT_POST, 'project_id', FILTER_SANITIZE_NUMBER_INT);
		$project_is_enabled = filter_input(INPUT_POST, 'project_is_enabled', FILTER_VALIDATE_INT);

		if($project_is_enabled == null || $project_is_enabled == 0)
		{	
			$project_is_enabled = 0;

			if($class_project->setEnabledProject($user_id, $project_id, $project_is_enabled))
			{
			   	$error_message = "Projeto desativado!";
			   	$_SESSION['error_message'] = $error_message;
		    	header("Location: " . URL_PATH . "project/edit/" . $project_id);
		    	exit;
			}
		}
	    else
	    {
			if($class_project->setEnabledProject($user_id, $project_id, $project_is_enabled))
			{
			    $success_message = "Projeto ativado!";
			    $_SESSION['success_message'] = $success_message;
		    	header("Location: " . URL_PATH . "project/edit/" . $project_id);
		    	exit;
			}	    			
	    }
	}
}