<?php
if (isset($_POST['form_create'])) {
    // Verifica se o token CSRF é válido
    if (!isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) {
        $error_message = "Token inválido. Tente novamente.";
        $_SESSION['error_message'] = $error_message;
        header("Location: " . URL_PATH . "project");
        exit;
    } else {
        // Recebe os inputs do formulário (form_project_create)
        $project_name = filter_input(INPUT_POST, 'project_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $project_color = filter_input(INPUT_POST, 'project_color', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $project_description = filter_input(INPUT_POST, 'project_description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $project_is_enabled = filter_input(INPUT_POST, 'project_is_enabled', FILTER_VALIDATE_INT);
        $project_datetime = date("Y-m-d H:i:s");

        // Verifica se a variável $project_is_enabled é nula ou está vazia
        if ($project_is_enabled == null || $project_is_enabled == 0) {
            $project_is_enabled = 0;
        }

        // Verifica se a variável $project_name está vazia
        if (empty($project_name)) {
            $error_message = "Nome não pode estar vazio!";
            $_SESSION['error_message'] = $error_message;
            header("Location: " . URL_PATH . "project");
            exit;
        }

        // Converte o nome em um slug usando a classe SlugConvert
        $project_slug = $class_slug_convert->convertingSlug($project_name);


        // Insere no banco de dados
        if ($class_project->setProjectCreate($user_id, $project_name, $project_slug, $project_color, $project_description, $project_is_enabled, $project_datetime)) {
            $success_message = "Projeto adicionado com sucesso!";
            $_SESSION['success_message'] = $success_message;
            header("Location: " . URL_PATH . "project");
            exit;
        } else {
            $error_message = "Já existe um projeto com esse nome!";
            $_SESSION['error_message'] = $error_message;
            header("Location: " . URL_PATH . "project");
            exit;
        }
    }
}
