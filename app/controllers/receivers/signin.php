<?php
if (isset($_POST['form_signin'])) {
	// Verifica se o token CSRF é válido
	if (!isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) {
		$error_message = "Token inválido. Tente novamente.";
		$_SESSION['error_message'] = $error_message;
		header("Location: " . URL_PATH . "signin");
		exit;
	} else {
		$token = $_POST['token'];
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$password = $_POST['password'];


		if (empty($email)) {
			$error_message = "E-mail não pode estar vazio!";
			$_SESSION['error_message'] = $error_message;
			header("Location: " . URL_PATH . "signin");
			exit;
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error_message = "E-mail inválido!";
			$_SESSION['error_message'] = $error_message;
			header("Location: " . URL_PATH . "signin");
			exit;
		}
		if (empty($password)) {
			$error_message = "Senha não pode estar vazia!";
			$_SESSION['error_message'] = $error_message;
			header("Location: " . URL_PATH . "signin");
			exit;
		}
		if ($class_auth->authLogin($email, $password, $token)) {
			$name = $_SESSION['user'];
			$user_id = $_SESSION['user_id'];
			$hora = date("H");
			$class_greet = new Greet();
			$greet = $class_greet->greeting($hora);
			$class_short_name = new ShortName();
			$short_name = $class_short_name->firstNameLastName($name);

			$success_message = "Login bem sucedido!";
			$_SESSION['success_message'] = $success_message;
			header("Location: " . URL_PATH . "schedule");
			exit;
		} else {
			$error_message = "E-mail ou senha inválidos!";
			$_SESSION['error_message'] = $error_message;
			header("Location: " . URL_PATH . "signin");
			exit;
		}
	}
}
