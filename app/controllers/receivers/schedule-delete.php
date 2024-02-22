<?php
if (isset($_POST['form_delete_event'])) {
	// Verifica se o token CSRF é válido
	if (!isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) {
		$error_message = "Token inválido. Tente novamente.";
		$_SESSION['error_message'] = $error_message;
		header("Location: " . URL_PATH . "schedule");
		exit;
	} else {
		$event_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

		if (!empty($event_id)) {
			if ($class_event->deleteEvent($event_id)) {
				$success_message = "Evento excluído com sucesso!";
				$_SESSION['success_message'] = $success_message;
				header("Location: " . URL_PATH . "schedule");
				exit;
			} else {
				$error_message = "Erro ao excluir evento. Tente novamente.";
				$_SESSION['error_message'] = $error_message;
				header("Location: " . URL_PATH . "schedule");
				exit;
			}
		} else {
			$error_message = "Algo saiu errado. Tente novamente.";
			$_SESSION['error_message'] = $error_message;
			header("Location: " . URL_PATH . "schedule");
			exit;
		}
	}
}
