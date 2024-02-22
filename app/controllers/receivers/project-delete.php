<?php
if (isset($_POST['form_delete']))
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

	    if (!empty($project_id)) 
	    {
		    if ($class_project->deleteProject($project_id)) 
		    {
		        $success_message = "project excluído com sucesso!";
		        $_SESSION['success_message'] = $success_message;
		        header("Location: " . URL_PATH . "project");
		        exit;
		    } 
		    else 
		    {
		        $error_message = "Erro ao excluir o projeto. Tente novamente.";
		        $_SESSION['error_message'] = $error_message;
		        header("Location: " . URL_PATH . "project");
		        exit;
		    }
	    }
	    else
	    {
	        $error_message = "Dados inválidos. Tente novamente.";
	        $_SESSION['error_message'] = $error_message;
	        header("Location: " . URL_PATH . "project");
	        exit;
	    }

    	
    }
}