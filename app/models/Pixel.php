<?php
/**
 * A lightweight PHP MVC Framework.
 * 
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BTECH. All rights reserved.
 * @link http://baggitech.com.br
 */

class Pixel extends Model
{
	public function getPixels() 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM pixels");
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $value) 
			{
				$array = $result;
			}
		}
		
		return $array;
	}

	public function getPixel($link_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM pixels WHERE link_id = :a");
		$statement->bindValue(":a", $link_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $value) 
			{
				$array = $result;
			}
		}
		return $array;
	}	

	public function getPixelByPixelId($pixel_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM pixels WHERE pixel_id = :pixel_id");
		$statement->bindValue(":pixel_id", $pixel_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$array = $result;

	        $_SESSION['pixel_id'] = $result['pixel_id'];
	        $_SESSION['pixel_platform'] = $result['pixel_platform'];
	        $_SESSION['link_id'] = $result['link_id'];
			
		}
		return $array;
	}

	public function getPixelsJoinLinksByUserId($user_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * 
			FROM pixels 
			LEFT JOIN links ON pixels.link_id = links.link_id 
			WHERE pixels.user_id = :user_id
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

	public function addPixel($user_id, $pixel_name, $link_id, $pixel_platform, $pixel_is_enabled, $pixel_date_time, $pixel_social_media) 
	{
		$statement = $this->db->prepare("SELECT pixel_id FROM pixels WHERE pixel_name = :pixel_name");
		$statement->bindValue(":pixel_name", $pixel_name);
		$statement->execute();
		if($statement->rowCount() == 0) 
		{
			$statement = $this->db->prepare("INSERT INTO pixels SET
				user_id = :user_id,
				pixel_name = :pixel_name,
				link_id = :link_id,
				pixel_platform = :pixel_platform,
				pixel_is_enabled = :pixel_is_enabled,
				pixel_date_time = :pixel_date_time,
				pixel_social_media = :pixel_social_media
			");
			$statement->bindValue(":user_id", $user_id);
			$statement->bindValue(":pixel_name", $pixel_name);
			$statement->bindValue(":link_id", $link_id);
			$statement->bindValue(":pixel_platform", $pixel_platform);
			$statement->bindValue(":pixel_is_enabled", $pixel_is_enabled);
			$statement->bindValue(":pixel_date_time", $pixel_date_time);
			$statement->bindValue(":pixel_social_media", $pixel_social_media);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}
	}

	public function editPixel($pixel_id, $user_id, $is_enabled) 
	{
		$statement = $this->db->prepare("SELECT * FROM pixels WHERE pixel_id = :a AND user_id = :b");
		$statement->bindValue(":a", $pixel_id);
		$statement->bindValue(":b", $user_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("UPDATE pixels SET 
				is_enabled = :a 
				WHERE pixel_id = :b AND user_id = :c
				");
			$statement->bindValue(":a", $is_enabled);
			$statement->bindValue(":b", $pixel_id);
			$statement->bindValue(":c", $user_id);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}

	}

	public function setPixelUpdateByPixelId($pixel_id, $pixel_name, $pixel_note, $pixel, $pixel_is_enabled, $pixel_last_date_time) 
	{
		$statement = $this->db->prepare("SELECT * FROM pixels WHERE pixel_id = :pixel_id");
		$statement->bindValue(":pixel_id", $pixel_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("UPDATE pixels SET 
				pixel_name = :pixel_name,
				pixel_note = :pixel_note,
				pixel = :pixel,
				pixel_is_enabled = :pixel_is_enabled,
				pixel_last_date_time = :pixel_last_date_time 
				WHERE pixel_id = :pixel_id
			");
			$statement->bindValue(":pixel_name", $pixel_name);
			$statement->bindValue(":pixel_note", $pixel_note);
			$statement->bindValue(":pixel", $pixel);
			$statement->bindValue(":pixel_is_enabled", $pixel_is_enabled);
			$statement->bindValue(":pixel_last_date_time", $pixel_last_date_time);
			$statement->bindValue(":pixel_id", $pixel_id);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}

	}


	public function getAllPixelsIsEnabledByUserID($user_id)
	{
	    $result = 0;
	    $statement = $this->db->prepare("SELECT COUNT(*) AS count FROM pixels WHERE user_id = :user_id AND pixel_is_enabled = :pixel_is_enabled");
	    $statement->bindValue(":user_id", $user_id);
	    $statement->bindValue(":pixel_is_enabled", intval(1));
	    $statement->execute();
	    $row = $statement->fetch(PDO::FETCH_ASSOC);
	    if ($row) 
	    {
	        $result = $row['count'];
	    }
	    
	    return $result;
	}

	public function getAllPixelsIsDisabledByUserID($user_id)
	{
	    $result = 0;
	    $statement = $this->db->prepare("SELECT COUNT(*) AS count FROM pixels WHERE user_id = :user_id AND pixel_is_enabled = :pixel_is_enabled");
	    $statement->bindValue(":user_id", $user_id);
	    $statement->bindValue(":pixel_is_enabled", intval(0));
	    $statement->execute();
	    if ($statement->rowCount() > 0) 
	    {	
	    	$row = $statement->fetch(PDO::FETCH_ASSOC);
	        $result = $row['count'];
	    }
	    
	    return $result;
	}


	public function enabledPixel($user_id, $pixel_id, $pixel_is_enabled) 
	{
		$statement = $this->db->prepare("SELECT * FROM pixels WHERE pixel_id = :pixel_id AND user_id = :user_id");
		$statement->bindValue(":pixel_id", $pixel_id);
		$statement->bindValue(":user_id", $user_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("UPDATE pixels SET pixel_is_enabled = :pixel_is_enabled WHERE pixel_id = :pixel_id");
			$statement->bindValue(":pixel_is_enabled", $pixel_is_enabled);
			$statement->bindValue(":pixel_id", $pixel_id);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}
	}



	public function deletePixel($pixel_id) 
	{
		$statement = $this->db->prepare("SELECT * FROM pixels WHERE pixel_id = :pixel_id");
		$statement->bindValue(":pixel_id", $pixel_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("DELETE FROM pixels WHERE pixel_id = :pixel_id");
			$statement->bindValue(":pixel_id", $pixel_id);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}

	}

}