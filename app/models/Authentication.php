<?php

/**
 * Projeto Agenda PHP PDO MVC.
 *
 * @author Lázaro Baggi
 * @copyright CTI SAEB - SECRETARIA DA ADMINISTRAÇÃO All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.git
 * 
 * 
 */

class Authentication extends Model
{
	// Adiciona um token CSRF exclusivo para cada formulário
	public function generateCsrfToken()
	{
		session_regenerate_id(true);
		//$token = session_id();
		$token = bin2hex(random_bytes(32));
		$_SESSION['csrf_token'] = $token;

		return $token;
	}

	public function authLogin($email, $password, $token)
	{
		// Utilizar hash mais forte para senha do usuário
		$hashed_password = hash('sha256', $password);

		// Verificar se o email do usuário existe
		$statement = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
		$statement->bindValue(":email", $email);
		$statement->execute();
		$user_exists = $statement->fetchColumn();
		// Se o email não existir, retorne mensagem de erro
		if ($user_exists == 0) {
			$error_message = "O email fornecido não existe em nosso sistema.";
			$_SESSION['error_message'] = $error_message;
			header("Location: " . URL_PATH . "signin");
			exit;
		} else {
			// Verificar se o email e a senha correspondem a um registro na tabela de usuários
			$statement = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email AND password = :password");
			$statement->bindValue(":email", $email);
			$statement->bindValue(":password", $hashed_password);
			$statement->execute();
			$user_password_match = $statement->fetchColumn();
			// Se a senha não corresponder, retorne mensagem de erro
			if ($user_password_match == 0) {
				$error_message = "A senha fornecida não corresponde ao email fornecido.";
				$_SESSION['error_message'] = $error_message;
				header("Location: " . URL_PATH . "signin");
				exit;
			} else {
				// Usar prepared statements do PDO para evitar SQL injection
				$statement = $this->db->prepare("UPDATE users SET token = :token WHERE email = :email");
				$statement->bindValue(':token', $token, PDO::PARAM_STR);
				$statement->bindValue(':email', $email, PDO::PARAM_STR);
				$statement->execute();

				// Usar prepared statements do PDO para evitar SQL injection e recuperar apenas as colunas necessárias
				$statement = $this->db->prepare("SELECT user_id, name, verified, level, email, code_verify, token FROM users WHERE email = :email AND password = :password");
				$statement->bindValue(":email", $email);
				$statement->bindValue(":password", $hashed_password);
				$statement->execute();
				$user = $statement->fetch(PDO::FETCH_ASSOC);

				// Verificar se a consulta SQL retorna apenas um resultado
				if ($user !== false && $statement->rowCount() == 1) {
					// Criar sessões com dados encontrados
					$_SESSION['user_id'] = $user['user_id'];
					$_SESSION['username'] = $user['name'];
					$_SESSION['user'] = $user['name'];
					$_SESSION['verified'] = $user['verified'];
					$_SESSION['level'] = $user['level'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['code_verify'] = $user['code_verify'];
					$_SESSION['token'] = $user['token'];

					return true;
				} else {
					return false;
				}
			}
		}
	}
	private function isTokenValid()
	{
		// Verifica se o token CSRF na sessão é válido comparando-o com o token do banco de dados.
		$statement = $this->db->prepare("SELECT token FROM users WHERE email = :email");
		$statement->bindValue(":email", $_SESSION['email']);
		$statement->execute();
		$user = $statement->fetch(PDO::FETCH_ASSOC);
		return ($user !== false && $statement->rowCount() == 1 && hash_equals($_SESSION['csrf_token'], $user['token']));
	}

	private function isLoggedIn()
	{
		// Verifica se o usuário está logado.
		return isset($_SESSION['user']) && !empty($_SESSION['user']);
	}

	private function isVerified()
	{
		// Verifica se o usuário foi verificado.
		return isset($_SESSION['verified']) && $_SESSION['verified'] == 1;
	}

	private function isLoggedInAndVerified()
	{
		// Verifica se o usuário está logado e verificado.
		return $this->isLoggedIn() && $this->isVerified();
	}

	public function requireLoggedInAndVerified()
	{
		// Verifica se o token é válido, se o usuário está logado e verificado.
		if (!$this->isTokenValid() || !$this->isLoggedInAndVerified()) {
			$error_message = "Precisa ter um token válido, estar logado e verificado!";
			$_SESSION['error_message'] = $error_message;
			header("Location: " . URL_PATH . "verify");
			exit;
		}
	}

	public function requireLogout()
	{
		// Verifica se o usuário está logado, se sim, redireciona para a página inicial.
		if ($this->isLoggedIn()) {
			header("Location: " . URL_PATH . "./dashboard");
			exit;
		}
	}
}
