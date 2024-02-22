<?php

/**
 * A lightweight PHP MVC Framework.
 * 
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BTECH. All rights reserved.
 * @link http://baggitech.com.br
 */

class Link extends Model
{


	public function getLinksSetting() 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM links_settings");
		$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row) 
		{
			$array[$row['key']] = $row['value'];
		}

		return $array;
	}

	public function editLinksSetting($backgrounds, $center_content, $dark_mode) 
	{
		$statement = $this->db->prepare("UPDATE links_settings SET
			backgrounds = :backgrounds,
			center_content = :center_content,
			dark_mode = :dark_mode
			WHERE id=1
			");
		$statement->bindValue(":backgrounds", $backgrounds);
		$statement->bindValue(":center_content", $center_content);
		$statement->bindValue(":dark_mode", $dark_mode);
		$statement->execute();

		return true;
	}


	public function getAllUsersLinks() 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM links");
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			$array = $result;
		}
		
		return $array;
	}

	public function getLinksByUserId($user_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * 
			FROM links 
			WHERE links.user_id = :user_id
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

	public function getLinkByLinkId($link_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM links WHERE link_id = :link_id");
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$array = $result;
			
		}
		return $array;
	}

	public function getLinksJoinDomainsByUserId($user_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * 
			FROM links 
			LEFT JOIN domains ON links.link_id = domains.link_id 
			WHERE links.user_id = :user_id
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

	public function getLinksJoinsAllTablesByUserId($user_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * 
			FROM links
			LEFT JOIN links_settings ON links.link_id = links_settings.link_id
			LEFT JOIN pixels ON links.link_id = pixels.link_id
			LEFT JOIN tracks ON links.link_id = tracks.link_id
			LEFT JOIN blocks ON links.link_id = blocks.link_id 
			LEFT JOIN domains ON links.link_id = domains.link_id 
			WHERE links.user_id = :user_id
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

	public function getLinksJoinsAllTablesByURL($url) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * 
			FROM links
			LEFT JOIN links_settings ON links.link_id = links_settings.link_id
			LEFT JOIN pixels ON links.link_id = pixels.link_id
			LEFT JOIN tracks ON links.link_id = tracks.link_id
			LEFT JOIN blocks ON links.link_id = blocks.link_id 
			LEFT JOIN domains ON links.link_id = domains.link_id 
			WHERE links.url = :url
		");
		$statement->bindValue(":url", $url);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			$array = $result;
		}

		return $array;
	}

	public function getLinkJoinsAllTablesByLinkId($link_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * 
			FROM links
			LEFT JOIN links_settings ON links.link_id = links_settings.link_id
			LEFT JOIN pixels ON links.link_id = pixels.link_id
			LEFT JOIN tracks ON links.link_id = tracks.link_id
			LEFT JOIN blocks ON links.link_id = blocks.link_id 
			LEFT JOIN domains ON links.link_id = domains.link_id 
			WHERE links.link_id = :link_id
		");
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$array = $result;
		}

		return $array;
	}

	public function getSettingLink($link_id) 
	{
		$array = array();
		$statement = $this->db->prepare("SELECT * FROM links_settings WHERE link_id = :link_id");
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			$array = $result;
		}
		
		return $array;
	}

    public function getTrackLink($link_id) 
    {
        $array = array();
        $statement = $this->db->prepare("SELECT * FROM tracks WHERE link_id = :link_id");
        $statement->bindValue(":link_id", $link_id);
        $statement->execute();
        if($statement->rowCount() > 0) 
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $array = $result;
        }
        
        return $array;
    }

	public function addLink($domain, $url)
	{
		// VERIFICA SE JÁ EXISTE O LINK
		$statement = $this->db->prepare("SELECT * FROM links WHERE url = :url");
		$statement->bindValue(":url", $url);
		$statement->execute();
		if($statement->rowCount() == 0) 
		{
			// INSERE O LINK COM DADOS BÁSICOS PARA O FUNCIONAMENTO
			$statement = $this->db->prepare("INSERT INTO links SET 
				url = :url,
				user_id = :user_id,
				type = :type,
				start_date = :start_date,
				link_is_enabled = :link_is_enabled
			");
			$statement->bindValue(":url", $url);
			$statement->bindValue(":user_id", $_SESSION['user_id']);
			$statement->bindValue(":type", "biolink");
			$statement->bindValue(":start_date", date("Y-m-d H:i:s"));
			$statement->bindValue(":link_is_enabled", 1);
			$statement->execute();

			// VERIFICA QUAL O ID DO LINK (link_id) E O ID DO USUÁRIO (user_id)
			// PARA USAR NAS TABELAS: (links_settings, pixels, tracks, domains) 
			$statement = $this->db->prepare("SELECT * FROM links WHERE url = :url");
			$statement->bindValue(":url", $url);
			$statement->execute();
			if($statement->rowCount() > 0) 
			{
				$result = $statement->fetch(PDO::FETCH_ASSOC);
				$user_id = $result['user_id'];
				$link_id = $result['link_id'];
			}

			// INSERE O ID DO LINK NA TABELA DE ESTILO CSS DO LINK
			$statement = $this->db->prepare("INSERT INTO links_settings SET 
				user_id = :user_id, 
				link_id = :link_id
			");
			$statement->bindValue(":user_id", $user_id);
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();

			// INSERE O ID DO LINK NA TABELA DE TRAQUEAMENTO DO LINK
			$statement = $this->db->prepare("INSERT INTO tracks SET 
				user_id = :user_id, 
				link_id = :link_id
			");
			$statement->bindValue(":user_id", $user_id);
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();

			// INSERE O ID DO LINK NA TABELA DE DOMÍNIO DO LINK
			$statement = $this->db->prepare("INSERT INTO domains SET 
				user_id = :user_id, 
				link_id = :link_id,
				domain = :domain
			");
			$statement->bindValue(":user_id", $user_id);
			$statement->bindValue(":link_id", $link_id);
			$statement->bindValue(":domain", $domain);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}
	}

	public function enabledLink($link_id, $link_is_enabled) 
	{
		$statement = $this->db->prepare("UPDATE links SET link_is_enabled = :link_is_enabled WHERE
		 link_id = :link_id
		 ");
		$statement->bindValue(":link_is_enabled", $link_is_enabled);
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();

		return true;
 	}

	public function updateURL($domain, $url, $link_id)
	{
		// RESPONSÁVEL POR VERIFICAR SE O NOVO NOME DADO AO CAMPO (url) 
		// JÁ EXISTE RELACIONADO A UM (link_id) DIFERENTE
		$statement = $this->db->prepare("SELECT * FROM links WHERE url = :url AND link_id != :link_id");
		$statement->bindValue(":url", $url);
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();
		if($statement->rowCount() == 0) 
		{
			$statement = $this->db->prepare("UPDATE links SET 
				url = :url
				WHERE link_id = :link_id
			 ");
			$statement->bindValue(":url", $url);
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();

			$statement = $this->db->prepare("UPDATE domains SET 
				domain = :domain
				WHERE link_id = :link_id
			 ");
			$statement->bindValue(":domain", $domain);
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();

			return true;
		} 
		else 
		{
			return false;
		}
	}

    public function updateSEO($robots, $title, $meta_description, $meta_keywords, $favicon, $link_id)
	{
		$statement = $this->db->prepare("UPDATE links_settings SET 
			robots = :robots, 
			title = :title, 
			meta_description = :meta_description, 
			meta_keywords = :meta_keywords, 
			favicon = :favicon
			WHERE link_id = :link_id
		");
		$statement->bindValue(":robots", $robots);
		$statement->bindValue(":title", $title);
		$statement->bindValue(":meta_description", $meta_description);
		$statement->bindValue(":meta_keywords", $meta_keywords);
		$statement->bindValue(":favicon", $favicon);
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();

		return true;
	}

	public function updateCodeSnippet($custom_css, $custom_body, $custom_js, $link_id)
	{
		$statement = $this->db->prepare("UPDATE links_settings SET 
			custom_css = :custom_css,
			custom_body = :custom_body,
			custom_js = :custom_js 
			WHERE link_id = :link_id
		");
		$statement->bindValue(":custom_css", $custom_css);
		$statement->bindValue(":custom_body", $custom_body);
		$statement->bindValue(":custom_js", $custom_js);
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();

		return true;
	}

    public function updateUTM($utm_source, $utm_medium, $utm_campaign, $utm_id, $utm_term, $utm_content, $utm_url, $link_id)
    {
        $statement = $this->db->prepare("UPDATE tracks SET 
            utm_source = :utm_source,
            utm_medium = :utm_medium,
            utm_campaign = :utm_campaign, 
            utm_id = :utm_id, 
            utm_term = :utm_term,
            utm_content = :utm_content,
            utm_url = :utm_url
            WHERE link_id = :link_id
        ");
        $statement->bindValue(":utm_source", $utm_source);
        $statement->bindValue(":utm_medium", $utm_medium);
        $statement->bindValue(":utm_campaign", $utm_campaign);
        $statement->bindValue(":utm_id", $utm_id);
        $statement->bindValue(":utm_term", $utm_term);
        $statement->bindValue(":utm_content", $utm_content);
        $statement->bindValue(":utm_url", $utm_url);
        $statement->bindValue(":link_id", $link_id);
        $statement->execute();

        return true;
    }

	public function updateFont($font_one, $font_two, $font_three, $font_size, $font_color, $link_id)
	{
		$statement = $this->db->prepare("UPDATE links_settings SET 
			font_one = :font_one,
			font_two = :font_two,
			font_three = :font_three, 
			font_size = :font_size, 
			font_color = :font_color
			WHERE link_id = :link_id
		");
		$statement->bindValue(":font_one", $font_one);
		$statement->bindValue(":font_two", $font_two);
		$statement->bindValue(":font_three", $font_three);
		$statement->bindValue(":font_size", $font_size);
		$statement->bindValue(":font_color", $font_color);
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();

		return true;
	}

	public function updateBackground($bg_type, $bg_id, $color1, $color2, $to_direction, $background_image, $link_id)
	{
		$statement = $this->db->prepare("UPDATE links_settings SET 
			bg_type = :bg_type, 
			bg_id = :bg_id, 
			color1 = :color1,
			color2 = :color2, 
			to_direction = :to_direction, 
			background_image = :background_image
			WHERE link_id = :link_id
		");
		$statement->bindValue(":bg_type", $bg_type);
		$statement->bindValue(":bg_id", $bg_id);
		$statement->bindValue(":color1", $color1);
		$statement->bindValue(":color2", $color2);
		$statement->bindValue(":to_direction", $to_direction);
		$statement->bindValue(":background_image", $background_image);
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();

		return true;
	}

	public function getAllLinksIsEnabledByUserID($user_id)
	{
	    $result = 0;
	    $statement = $this->db->prepare("SELECT COUNT(*) AS count FROM links WHERE user_id = :user_id AND link_is_enabled = :link_is_enabled");
	    $statement->bindValue(":user_id", $user_id);
	    $statement->bindValue(":link_is_enabled", intval(1));
	    $statement->execute();
	    $row = $statement->fetch(PDO::FETCH_ASSOC);
	    if ($row) 
	    {
	        $result = $row['count'];
	    }
	    
	    return $result;
	}

	public function getAllLinksIsDisabledByUserID($user_id)
	{
	    $result = 0;
	    $statement = $this->db->prepare("SELECT COUNT(*) AS count FROM links WHERE user_id = :user_id AND link_is_enabled = :link_is_enabled");
	    $statement->bindValue(":user_id", $user_id);
	    $statement->bindValue(":link_is_enabled", intval(0));
	    $statement->execute();
	    if ($statement->rowCount() > 0) 
	    {	
	    	$row = $statement->fetch(PDO::FETCH_ASSOC);
	        $result = $row['count'];
	    }
	    
	    return $result;
	}

	public function deleteLink($link_id) 
	{
		$statement = $this->db->prepare("SELECT * FROM links WHERE link_id = :link_id");
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
			$statement = $this->db->prepare("DELETE FROM links WHERE link_id = :link_id");
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();

			$statement = $this->db->prepare("DELETE FROM links_settings WHERE link_id = :link_id");
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();

			$statement = $this->db->prepare("DELETE FROM pixels WHERE link_id = :link_id");
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();

			$statement = $this->db->prepare("DELETE FROM tracks WHERE link_id = :link_id");
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();

			$statement = $this->db->prepare("DELETE FROM blocks WHERE link_id = :link_id");
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();

			$statement = $this->db->prepare("DELETE FROM domains WHERE link_id = :link_id");
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();

			$statement = $this->db->prepare("DELETE FROM qrcodes WHERE link_id = :link_id");
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();

			// IMPLEMENTAÇÕES:
			// DELETAR ARQUIVOS DE IMAGENS GERADOS PELO SISTEMA QUE PERTENCEM AO LINK
			// DELETAR ARQUIVOS DE IMAGENS INSERIDOS PELO USUÁRIO QUE PERTENCEM AO LINK
			// DELETAR BASE DE DADOS DE SHORTLINKS QUE PERTENCEM AO LINK

			return true;
		} 
		else 
		{
			return false;
		}
	}
}