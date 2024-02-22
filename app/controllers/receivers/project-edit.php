<?php
if(isset($_POST['form_edit']))
{
    // Verifica se o token CSRF é válido
    if (!isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) 
    {
        $_SESSION['error_message'] = "Token inválido. Tente novamente.";
        header("Location: " . URL_PATH . "project");
        exit;
    }
    else
    {
	    $project_id = filter_input(INPUT_POST, 'project_id', FILTER_SANITIZE_NUMBER_INT);

	    if(!empty($project_id))
	    {	
	        if($class_project->getProjectByProjectId($project_id))
	        {
	        	header("Location: ".URL_PATH."project/edit/".$project_id);
				exit;
	        }
		    else
		    {
		    	$error_message = "Pixel não existe!";
			   	$_SESSION['error_message'] = $error_message;
			   	header("Location: " . URL_PATH . "project");
			   	exit;
		    }
	    }    	
    }
}

