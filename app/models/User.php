<?php
/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
 */


class User extends Model
{
	public function getUsers()
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM users");
		$statement->execute();
		$result = $statement->rowCount();
		$array = $result;

		return $array;
	}

	public function getUser($user_id)
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM users WHERE user_id = :user_id");
		$statement->bindValue(":user_id", $user_id);
		$statement->execute();
		if ($statement->rowCount() > 0) {
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$array = $result;
		}

		return $array;
	}

	public function getProfile($name)
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM users WHERE name = :a");
		$statement->bindValue(":a", $name);
		$statement->execute();
		if ($statement->rowCount() > 0) {
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$array = $result;

			return $array;
		}
	}

	public function addUser($name, $email, $password, $code_verify)
	{
		$statement = $this->db->prepare("SELECT user_id FROM users WHERE email = :email");
		$statement->bindValue(":email", $email);
		$statement->execute();
		if ($statement->rowCount() == 0) {
			$statement = $this->db->prepare("INSERT INTO users SET
				name = :name,
				email = :email,
				password = :password,
				level = :level,
				code_verify = :code_verify
				");
			$statement->bindValue(":name", $name);
			$statement->bindValue(":email", $email);
			$statement->bindValue(":password", hash('sha256', $password));
			$statement->bindValue(":level", 1);
			$statement->bindValue(":code_verify", $code_verify);
			$statement->execute();

			$_SESSION['name'] = $name;
			$_SESSION['email'] = $email;
			$_SESSION['code_verify'] = $code_verify;

			return true;
		} else {
			return false;
		}
	}

	public function editPersonalData($user_id, $name, $birth_date, $address, $city, $state, $zip_code, $country)
	{
		$statement = $this->db->prepare("SELECT * FROM users WHERE user_id = :user_id");
		$statement->bindValue(":user_id", $user_id);
		$statement->execute();
		if ($statement->rowCount() > 0) {
			$statement = $this->db->prepare("UPDATE users SET
				name = :name,
				birth_date = :birth_date,
				address = :address,
				city = :city,
				state = :state,
				zip_code = :zip_code,
				country = :country
				WHERE user_id = :user_id
				");
			$statement->bindValue(":name", $name);
			$statement->bindValue(":birth_date", $birth_date);
			$statement->bindValue(":address", $address);
			$statement->bindValue(":city", $city);
			$statement->bindValue(":state", $state);
			$statement->bindValue(":zip_code", $zip_code);
			$statement->bindValue(":country", $country);
			$statement->bindValue(":user_id", $user_id);
			$statement->execute();

			return true;
		} else {
			return false;
		}
	}

	public function recoveryPassword($email, $password)
	{
		// Preparar a consulta SQL para selecionar o usuário com o email fornecido
		$selectStatement = $this->db->prepare("SELECT * FROM users WHERE email = :email");
		$selectStatement->bindValue(":email", $email);
		$selectStatement->execute();

		// Verificar se há um único usuário com o email fornecido
		if ($selectStatement->rowCount() == 1) {
			// Recuperar os resultados como um array associativo
			$user = $selectStatement->fetch(PDO::FETCH_ASSOC);

			// Atualizar a senha do usuário
			$updateStatement = $this->db->prepare("UPDATE users SET 
	        	password = :password 
	        	WHERE email = :email
	        ");
			$updateStatement->bindValue(":password", hash('sha256', $password));
			$updateStatement->bindValue(":email", $email);
			$updateStatement->execute();

			// Armazenar informações mínimas do usuário na sessão (não armazene a senha)
			//$_SESSION['user_id'] = $user['id'];
			//$_SESSION['name'] = $user['name'];
			//$_SESSION['email'] = $user['email'];

			// Retornar verdadeiro para indicar que a recuperação de senha foi bem-sucedida
			return true;
		} else {
			// Não encontrou um único usuário com o email fornecido, então retornar falso
			return false;
		}
	}

	public function checkVerifyCode($email, $code_verify)
	{
		$statement = $this->db->prepare("SELECT * FROM users WHERE email = :email AND code_verify = :code_verify");
		$statement->bindValue(":email", $email);
		$statement->bindValue(":code_verify", $code_verify);
		$statement->execute();
		if ($statement->rowCount() > 0) {
			$statement = $this->db->prepare("UPDATE users SET 
				verified = :verified 
				WHERE email = :email
				");
			$statement->bindValue(":verified", 1);
			$statement->bindValue(":email", $email);
			$statement->execute();

			return true;
		} else {
			return false;
		}
	}
}
