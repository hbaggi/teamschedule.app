<?php
if (isset($_POST['form_edit_event'])) {
    // Verifica se o token CSRF é válido
    if (!isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) {
        $error_message = "Token inválido. Tente novamente.";
        $_SESSION['error_message'] = $error_message;
        header("Location: " . URL_PATH . "schedule");
        exit;
    } else {

        $id = filter_input(INPUT_POST, 'edit_id', FILTER_SANITIZE_NUMBER_INT);
        $title = filter_input(INPUT_POST, 'edit_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $color = filter_input(INPUT_POST, 'edit_color', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $start = filter_input(INPUT_POST, 'edit_start', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $end = filter_input(INPUT_POST, 'edit_end', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $schedule_datetime = date("Y-m-d H:i:s");

        // Remove espaços em branco do início e do final da string
        $title = trim($title);

        if (empty($title) || strlen($title) == 0) {
            $error_message = "Evento tem que ter um tìtulo!2";
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

        if ($class_event->updateEvent($id, $title, $color, $start, $end)) {
            $success_message = "Evento atualizado com sucesso!";
            $_SESSION['success_message'] = $success_message;
            header("Location: " . URL_PATH . "schedule");
            exit;
        } else {
            $error_message = "Algo saiu errado!";
            $_SESSION['error_message'] = $error_message;
            header("Location: " . URL_PATH . "schedule");
            exit;
        }
    }
}
