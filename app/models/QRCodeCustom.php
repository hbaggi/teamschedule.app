<?php

/**
 * A lightweight PHP MVC Framework.
 * 
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BTECH. All rights reserved.
 * @link http://baggitech.com.br
 */


class QRCodeCustom extends Model
{

	public function getQRCodesJoinsLinksByUserId($user_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * 
			FROM qrcodes 
			LEFT JOIN links ON qrcodes.link_id = links.link_id
			LEFT JOIN domains ON qrcodes.link_id = domains.link_id 
			WHERE qrcodes.user_id = :user_id ORDER BY qrcodes.qrcode_id DESC
		");
		$statement->bindValue(":user_id", $user_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			$array = $result;
			
		}
		return $array;
	}

	public function getQRCodeByQRCodeId($qrcode_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM qrcodes WHERE qrcode_id = :qrcode_id");
		$statement->bindValue(":qrcode_id", $qrcode_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$array = $result;

	        $_SESSION['qrcode_id'] = $result['qrcode_id'];
	        $_SESSION['qrcode_type'] = $result['qrcode_type'];
	        $_SESSION['link_id'] = $result['link_id'];
			
		}
		return $array;
	}

	public function setQRCodeCreate($user_id, $link_id, $qrcode_is_enabled, $qrcode_type, $qrcode_name, $qrcode_fields, $qrcode_image, $qrcode_date_time)
	{
		// VERIFICA SE JÁ EXISTE O NOME DADO AO QR CODE
		$statement = $this->db->prepare("SELECT * FROM qrcodes WHERE qrcode_name = :qrcode_name");
		$statement->bindValue(":qrcode_name", $qrcode_name);
		$statement->execute();
		if($statement->rowCount() == 0) 
		{
			// INSERE O QR CODE COM DADOS BÁSICOS PARA O FUNCIONAMENTO
			$statement = $this->db->prepare("INSERT INTO qrcodes SET
				user_id = :user_id, 
				link_id = :link_id,
				qrcode_is_enabled = :qrcode_is_enabled,
				qrcode_type = :qrcode_type,
				qrcode_name = :qrcode_name,
				qrcode_fields = :qrcode_fields,
				qrcode_image = :qrcode_image,
				qrcode_date_time = :qrcode_date_time
			");
			$statement->bindValue(":user_id", $user_id);
			$statement->bindValue(":link_id", $link_id);
			$statement->bindValue(":qrcode_is_enabled", $qrcode_is_enabled);
			$statement->bindValue(":qrcode_type", $qrcode_type);
			$statement->bindValue(":qrcode_name", $qrcode_name);
			$statement->bindValue(":qrcode_fields", $qrcode_fields);
			$statement->bindValue(":qrcode_image", $qrcode_image);
			$statement->bindValue(":qrcode_date_time", $qrcode_date_time);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}
	}


	public function setQRCodeUpdate($qrcode_id, $qrcode_fields) 
	{
		$statement = $this->db->prepare("SELECT * FROM qrcodes WHERE qrcode_id = :qrcode_id");
		$statement->bindValue(":qrcode_id", $qrcode_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("UPDATE qrcodes SET qrcode_fields = :qrcode_fields 
				WHERE qrcode_id = :qrcode_id
			");
			$statement->bindValue(":qrcode_id", $qrcode_id);
			$statement->bindValue(":qrcode_fields", $qrcode_fields);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}

	}

	public function enabledQRCode($user_id, $qrcode_id, $qrcode_is_enabled) 
	{
		$statement = $this->db->prepare("SELECT * FROM qrcodes WHERE qrcode_id = :qrcode_id AND user_id = :user_id");
		$statement->bindValue(":qrcode_id", $qrcode_id);
		$statement->bindValue(":user_id", $user_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("UPDATE qrcodes SET qrcode_is_enabled = :qrcode_is_enabled WHERE qrcode_id = :qrcode_id");
			$statement->bindValue(":qrcode_is_enabled", $qrcode_is_enabled);
			$statement->bindValue(":qrcode_id", $qrcode_id);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}
	}

	public function getAllQRCodesIsEnabledByUserID($user_id)
	{
	    $result = 0;
	    $statement = $this->db->prepare("SELECT COUNT(*) AS count FROM qrcodes WHERE user_id = :user_id AND qrcode_is_enabled = :qrcode_is_enabled");
	    $statement->bindValue(":user_id", $user_id);
	    $statement->bindValue(":qrcode_is_enabled", intval(1));
	    $statement->execute();
	    $row = $statement->fetch(PDO::FETCH_ASSOC);
	    if ($row) 
	    {
	        $result = $row['count'];
	    }
	    
	    return $result;
	}

	public function getAllQRCodesIsDisabledByUserID($user_id)
	{
	    $result = 0;
	    $statement = $this->db->prepare("SELECT COUNT(*) AS count FROM qrcodes WHERE user_id = :user_id AND qrcode_is_enabled = :qrcode_is_enabled");
	    $statement->bindValue(":user_id", $user_id);
	    $statement->bindValue(":qrcode_is_enabled", intval(0));
	    $statement->execute();
	    if ($statement->rowCount() > 0) 
	    {	
	    	$row = $statement->fetch(PDO::FETCH_ASSOC);
	        $result = $row['count'];
	    }
	    
	    return $result;
	}

	public function deleteQRCode($qrcode_id) 
	{
		$statement = $this->db->prepare("SELECT * FROM qrcodes WHERE qrcode_id = :qrcode_id");
		$statement->bindValue(":qrcode_id", $qrcode_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("DELETE FROM qrcodes WHERE qrcode_id = :qrcode_id");
			$statement->bindValue(":qrcode_id", $qrcode_id);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}

	}


}