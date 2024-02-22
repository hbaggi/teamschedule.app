<?php
if (isset($_POST['form_verify'])) {
	// Verifica se o token CSRF é válido
	if (!isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) {
		$error_message = "Token inválido. Tente novamente.";
		$_SESSION['error_message'] = $error_message;
		header("Location: " . URL_PATH . "verify");
		exit;
	} else {

		$email = $_SESSION['email'];
		$code_verify = $_POST['code_verify'];

		if (empty($code_verify)) {
			$error_message = "Campo não pode estar vazio!";
			$_SESSION['error_message'] = $error_message;
			header("Location: " . URL_PATH . "verify");
			exit;
		}
		if (!filter_var($code_verify, FILTER_VALIDATE_INT)) {
			$error_message = "Só números são permitidos!";
			$_SESSION['error_message'] = $error_message;
			header("Location: " . URL_PATH . "verify");
			exit;
		}
		if ($class_user->checkVerifyCode($email, $code_verify)) {
			$success_message = "Código verificado com Sucesso!";
			$_SESSION['success_message'] = $success_message;
			header("Location: " . URL_PATH . "logout");
			exit;
		} else {
			$error_message = "Código não confere!";
			$_SESSION['error_message'] = $error_message;
			header("Location: " . URL_PATH . "verify");
			exit;
		}
	}
}
