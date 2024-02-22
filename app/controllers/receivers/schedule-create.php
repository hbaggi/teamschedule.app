<?php
if (isset($_POST['form_create_event'])) {
    // Verifica se o token CSRF é válido
    if (!isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) {
        $error_message = "Token inválido. Tente novamente.";
        $_SESSION['error_message'] = $error_message;
        header("Location: " . URL_PATH . "schedule");
        exit;
    } else {

        // $title = filter_input(INPUT_POST, 'cad_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $color = filter_input(INPUT_POST, 'cad_color', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $start = filter_input(INPUT_POST, 'cad_start', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $end = filter_input(INPUT_POST, 'cad_end', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $title =  $dados['cad_title'];
        $color = $dados['cad_color'];
        $start = $dados['cad_start'];
        $end = $dados['cad_end'];

        $schedule_datetime = date("Y-m-d H:i:s");

        // Remove espaços em branco do início e do final da string
        $title = trim($title);

        if (empty($title) || strlen($title) == 0) {
            $error_message = "Evento tem que ter um tìtulo!";
            $_SESSION['error_message'] = $error_message;
            header("Location: " . URL_PATH . "schedule");
            exit;
        }

        if ($end < $start) {
            $error_message = "Data final não pode ser anterior a data inicial!";
            $_SESSION['error_message'] = $error_message;
            header("Location: " . URL_PATH . "schedule");
            exit;
        }

        // Insere no banco de dados
        if ($class_event->addEvent($title, $color, $start, $end, $user_id)) {
            $success_message = "Evento adicionado com sucesso!";
            $_SESSION['success_message'] = $success_message;
            header("Location: " . URL_PATH . "schedule");
            exit;
        } else {
            $error_message = "Já existe um projeto com esse nome!";
            $_SESSION['error_message'] = $error_message;
            header("Location: " . URL_PATH . "schedule");
            exit;
        }
    }
}
