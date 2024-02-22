<?php
if (isset($_POST['form_recovery_pass']))
{
    // Verifica se o token CSRF é válido
    if (!isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) 
    {
        $error_message = "Token inválido! Tente novamente.";
        $_SESSION['error_message'] = $error_message;
        header("Location: " . URL_PATH . "recovery/password");
        exit;
    }
    else
    {
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$password = $_POST['password']; // Não é necessário filtrar
		$confirm_password = $_POST['confirm_password']; // Não é necessário filtrar


		// Validação do campo "email"
		if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
		    // O campo "email" é obrigatório e deve ser um endereço de email válido
			$error_message = "Por favor, forneça um endereço de email válido.";
			$_SESSION['error_message'] = $error_message;
		   	header("Location: " . URL_PATH . "recovery/password");
		   	exit;
		}

		// Validação do campo "password"
		if(empty($password))
		{
			$error_message = "Senha não pode estar vazia!";
			$_SESSION['error_message'] = $error_message;
		   	header("Location: ".URL_PATH."recovery/password");
		   	exit;
		}

		// Validação do campo "password"
		if(empty($confirm_password))
		{
			$error_message = "Confirmação de senha não pode estar vazia!";
			$_SESSION['error_message'] = $error_message;
		   	header("Location: ".URL_PATH."recovery/password");
		   	exit;
		}

		// Validação do campo "confirm_password"
		if ($password !== $confirm_password) 
		{
		    // O campo "captcha" está incorreto ou em branco
			$error_message = "Senhas não conferem!";
			$_SESSION['error_message'] = $error_message;
		   	header("Location: " . URL_PATH . "recovery/password");
		   	exit;
		}

		if($class_user->recoveryPassword($email, $password)) 
		{	
			//require_once(__DIR__.'/../../vendor/PHPMailer-master/verify-email.php');
			   		
			$success_message = "Senha atualizada com sucesso!";
			$_SESSION['success_message'] = $success_message;
		   	header("Location: " . URL_PATH . "recovery/changed");
		   	exit;
		}
		else
		{	
			$error_message = "Algo saiu errado!";
			$_SESSION['error_message'] = $error_message;
		   	header("Location: " . URL_PATH . "recovery/password");
		   	exit;
		}
    }
}




