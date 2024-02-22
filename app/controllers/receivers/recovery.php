<?php
if (isset($_POST['form_recovery']))
{
    // Verifica se o token CSRF é válido
    if (!isset($_POST['token']) || !hash_equals($_SESSION['csrf_token'], $_POST['token'])) 
    {
        $error_message = "Token inválido. Tente novamente.";
        $_SESSION['error_message'] = $error_message;
        header("Location: " . URL_PATH . "recovery");
        exit;
    }
    else
    {
		// Função para gerar um token aleatório
		function generateToken($length = 16)
		{
		    return bin2hex(random_bytes($length));
		}

		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

		// Verifica se a variável ($email) não está vazia
		if (!empty($email)) 
		{
		    // Verifica se o e-mail existe na tabela (users)
		    if ($class_recovery->checkEmailUsersTable($email)) 
		    {
		    	// Gera um token aleatório
			    $token = generateToken();

			    // Verifica se o email existe na tabela (recovery_token)
		        if($class_recovery->checkEmailRecoveryTable($email))
		        {
		        	// Gera um token novo no lugar do antigo
					$class_recovery->checkValidToken($email, $token);
		        }
		        else
		        {
			        // Cria um token de recuperação novo.
			        $class_recovery->addToken($email, $token);
		        }

			    // cria link de redefinição de senha
			    $resetLink = "https://poptag.app/recovery/password/?token=" . urlencode($token);

			    $addresses = $email;
			    $subject = 'Recuperação de conta';
			    $body = '<b>Link:</b><br><br><a href="'.$resetLink.'">'.$resetLink.'</a>';

			    if($class_email_recovery_link->sendEmail($addresses, $subject, $body))
			    {
			      	// Exibe uma mensagem de sucesso para o usuário
					$success_message = "Verifique o seu e-mail!";
					$_SESSION['success_message'] = $success_message;
					header("Location: " . URL_PATH . "recovery/requested");
					exit;
			    }
			    else
			    {
					$error_message = "Algo saiu errado!";
					$_SESSION['error_message'] = $error_message;
					header("Location: " . URL_PATH . "recovery");
					exit;
			    }
		    }
		    else
		    {
				$error_message = "Email não existe em nossa base de dados!";
				$_SESSION['error_message'] = $error_message;
				header("Location: ".URL_PATH."recovery");
				exit;
			}
		}
		else
		{
			$error_message = "Email não pode estar vazio!";
			$_SESSION['error_message'] = $error_message;
			header("Location: " . URL_PATH . "recovery");
			exit;
		}    	

    }
}