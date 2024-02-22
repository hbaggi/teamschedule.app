<?php

/**
 * A lightweight PHP MVC Framework.
 * 
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BTECH. All rights reserved.
 * @link http://baggitech.com.br
 */


class Heading extends Model
{
	public function getHeadingsByLinkId($link_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM headings WHERE link_id = :link_id");
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			$array = $result;
		}

		return $array;
	}

	public function setHeadingCreate($user_id, $link_id, $heading_text)
	{
		$statement = $this->db->prepare("SELECT * FROM headings WHERE link_id = :link_id");
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();
		if($statement->rowCount() == 0) 
		{
			$statement = $this->db->prepare("INSERT INTO headings SET
				user_id = :user_id,
				link_id = :link_id,
				avatar_is_enabled = :avatar_is_enabled,
				avatar_date_time = :avatar_date_time,
				avatar_last_date_time = :avatar_last_date_time,
				avatar_image = :avatar_image,
				avatar_alt = :avatar_alt,
				avatar_size_width = :avatar_size_width,
				avatar_size_height = :avatar_size_height,
				avatar_border_radius = :avatar_border_radius
			");
			$statement->bindValue(":user_id", $user_id);
			$statement->bindValue(":link_id", $link_id);
			$statement->bindValue(":avatar_is_enabled", 1);
			$statement->bindValue(":avatar_date_time",  date("Y-m-d H:i:s"));
			$statement->bindValue(":avatar_last_date_time",  date("Y-m-d H:i:s"));
			$statement->bindValue(":avatar_image", $avatar_image);
			$statement->bindValue(":avatar_alt", "avatar");
			$statement->bindValue(":avatar_size_width", $avatar_size_width);
			$statement->bindValue(":avatar_size_height", $avatar_size_height);
			$statement->bindValue(":avatar_border_radius", $avatar_border_radius);
			$statement->execute();

			return true;
		}
		else
		{	
			return false;
		}

	}

	public function deleteHeading($avatar_id, $block_id) 
	{
		$statement = $this->db->prepare("SELECT * FROM avatars WHERE avatar_id = :avatar_id");
		$statement->bindValue(":avatar_id", $avatar_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("DELETE FROM avatars WHERE avatar_id = :avatar_id");
			$statement->bindValue(":avatar_id", $avatar_id);
			$statement->execute();

			$statement = $this->db->prepare("DELETE FROM blocks WHERE block_id = :block_id");
			$statement->bindValue(":block_id", $block_id);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}
	}
}