<?php

/**
 * A lightweight PHP MVC Framework.
 * 
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BTECH. All rights reserved.
 * @link http://baggitech.com.br
 */


class Project extends Model
{

	public function getProjectsByUserId($user_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM projects WHERE user_id = :user_id");
		$statement->bindValue(":user_id", $user_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			$array = $result;
		}

		return $array;
	}

	public function getProjectByProjectId($project_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM projects WHERE project_id = :project_id");
		$statement->bindValue(":project_id", $project_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$array = $result;

	        $_SESSION['project_id'] = $result['project_id'];
			
		}
		return $array;
	}

	public function setProjectCreate($user_id, $project_name, $project_slug, $project_color, $project_description, $project_is_enabled, $project_datetime)
	{
		$statement = $this->db->prepare("SELECT * FROM projects WHERE project_name = :project_name");
		$statement->bindValue(":project_name", $project_name);
		$statement->execute();
		if($statement->rowCount() == 0) 
		{
			$statement = $this->db->prepare("INSERT INTO projects SET
				user_id = :user_id,
				project_name = :project_name,
				project_slug = :project_slug,
				project_color = :project_color,
				project_description = :project_description, 
				project_is_enabled = :project_is_enabled,				
				project_datetime = :project_datetime
			");
			$statement->bindValue(":user_id", $user_id);
			$statement->bindValue(":project_name", $project_name);
			$statement->bindValue(":project_slug", $project_slug);
			$statement->bindValue(":project_color", $project_color);
			$statement->bindValue(":project_description", $project_description);
			$statement->bindValue(":project_is_enabled", $project_is_enabled);
			$statement->bindValue(":project_datetime", $project_datetime);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}
	}

	public function setProjectUpdateByProjectId($project_id, $project_name, $project_slug, $project_color, $project_description, $project_is_enabled, $project_last_datetime) 
	{
		$statement = $this->db->prepare("SELECT * FROM projects WHERE project_id = :project_id");
		$statement->bindValue(":project_id", $project_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("UPDATE projects SET 
				project_name = :project_name,
				project_slug = :project_slug,
				project_color = :project_color,
				project_description = :project_description,
				project_is_enabled = :project_is_enabled,
				project_last_datetime = :project_last_datetime 
				WHERE project_id = :project_id
			");
			$statement->bindValue(":project_name", $project_name);
			$statement->bindValue(":project_slug", $project_slug);
			$statement->bindValue(":project_color", $project_color);
			$statement->bindValue(":project_description", $project_description);
			$statement->bindValue(":project_is_enabled", $project_is_enabled);
			$statement->bindValue(":project_last_datetime", $project_last_datetime);
			$statement->bindValue(":project_id", $project_id);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}

	}

	public function setEnabledProject($user_id, $project_id, $project_is_enabled) 
	{
		$statement = $this->db->prepare("SELECT * FROM projects WHERE project_id = :project_id AND user_id = :user_id");
		$statement->bindValue(":project_id", $project_id);
		$statement->bindValue(":user_id", $user_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("UPDATE projects SET project_is_enabled = :project_is_enabled WHERE project_id = :project_id");
			$statement->bindValue(":project_is_enabled", $project_is_enabled);
			$statement->bindValue(":project_id", $project_id);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}
	}

	// Responsável por mostrar os projetos ativos na página de projetos do usuário
	public function getAllProjectsIsEnabledByUserID($user_id)
	{
	    $result = 0;
	    $statement = $this->db->prepare("SELECT COUNT(*) AS count FROM projects WHERE user_id = :user_id AND project_is_enabled = :project_is_enabled");
	    $statement->bindValue(":user_id", $user_id);
	    $statement->bindValue(":project_is_enabled", intval(1));
	    $statement->execute();
	    $row = $statement->fetch(PDO::FETCH_ASSOC);
	    if ($row) 
	    {
	        $result = $row['count'];
	    }
	    
	    return $result;
	}

	// Responsável por mostrar os projetos inativoss na página de projetos do usuário
	public function getAllProjectsIsDisabledByUserID($user_id)
	{
	    $result = 0;
	    $statement = $this->db->prepare("SELECT COUNT(*) AS count FROM projects WHERE user_id = :user_id AND project_is_enabled = :project_is_enabled");
	    $statement->bindValue(":user_id", $user_id);
	    $statement->bindValue(":project_is_enabled", intval(0));
	    $statement->execute();
	    if ($statement->rowCount() > 0) 
	    {	
	    	$row = $statement->fetch(PDO::FETCH_ASSOC);
	        $result = $row['count'];
	    }
	    
	    return $result;
	}


	public function deleteProject($project_id) 
	{
		$statement = $this->db->prepare("SELECT * FROM projects WHERE project_id = :project_id");
		$statement->bindValue(":project_id", $project_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("DELETE FROM projects WHERE project_id = :project_id");
			$statement->bindValue(":project_id", $project_id);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}
	}
}