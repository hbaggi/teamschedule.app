<?php
if (isset($_GET['token']))
{
	$recovery_token = $_GET['token'];

	$data['recovery_link'] = $class_recovery->getEmailAndTokenRecovery($recovery_token);

	if($recovery_token === $data['recovery_link']['token'])
	{
		$_SESSION['recovery_token'] = $data['recovery_link']['token'];
		$_SESSION['email'] = $data['recovery_link']['email'];
		$email = $_SESSION['email'];
		$class_user->checkVerifyCode($email);
	}
	else
	{
		$error_message = "Token inválido! Tente novamente.";
		$_SESSION['error_message'] = $error_message;
		header("Location: ".URL_PATH."recovery");
		exit;		
	}
}
