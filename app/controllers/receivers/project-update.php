<?php
if (isset($_POST['form_update']))
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
        $project_name = filter_input(INPUT_POST, 'project_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $project_color = filter_input(INPUT_POST, 'project_color', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $project_description = filter_input(INPUT_POST, 'project_description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $project_is_enabled = filter_input(INPUT_POST, 'project_is_enabled', FILTER_VALIDATE_INT);
		$project_last_datetime = date("Y-m-d H:i:s");


        // Converte o nome em um slug usando a classe SlugConvert
        $project_slug = $class_slug_convert->convertingSlug($project_name);

        // Verifica se a variável $project_is_enabled é nula ou está vazia
        if($project_is_enabled == null || $project_is_enabled == 0)
        {
            $project_is_enabled = 0;
        }

		if(!empty($project_id))
		{

			$class_project->setProjectUpdateByProjectId($project_id, $project_name, $project_slug, $project_color, $project_description, $project_is_enabled, $project_last_datetime);	

			$success_message = "Projeto atualizado com sucesso!";
			$_SESSION['success_message'] = $success_message;
			header("Location: " . URL_PATH . "project/edit/" . $project_id);
			exit;
		}
		else
		{
	    	$error_message = "Erro ao atualizar!";
	    	$_SESSION['error_message'] = $error_message;
	    	header("Location: " . URL_PATH . "project/edit/" . $project_id);
	    	exit;	
		}

    }
}

