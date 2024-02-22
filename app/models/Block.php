<?php

/**
 * A lightweight PHP MVC Framework.
 * 
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BTECH. All rights reserved.
 * @link http://baggitech.com.br
 */


class Block extends Model
{

	/**
	* QUANTIDADE DE BLOCOS POR BIOLINK
	* @var int
	*/
	const AVATAR = 0;
	const HEADING = 5;
	const PARAGRAPH = 5;

    public function getBlocks($link_id) 
    {
        $array = array();
        $statement = $this->db->prepare("SELECT * FROM blocks WHERE link_id = :link_id ORDER BY block_orderliness ASC");
        $statement->bindValue(":link_id", $link_id);
        $statement->execute();
        if($statement->rowCount() > 0) 
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
			$array = $result;
        }
        
        return $array;
    }

	public function setBlockCreate($user_id, $link_id, $block_type)
	{

		// Cria um array com os tipos definidos acima
		$blockToType = [
		    'avatar' => self::AVATAR,
		    'heading'  => self::HEADING,
		    'paragraph'  => self::PARAGRAPH,
		];
		$type = $blockToType[$block_type] ?? '';

		$statement = $this->db->prepare("SELECT * FROM blocks WHERE block_type = :block_type AND link_id = :link_id");
		$statement->bindValue(":block_type", $block_type);
		$statement->bindValue(":link_id", $link_id);
		$statement->execute();
		if($statement->rowCount() <= $type) 
		{
			$statement = $this->db->prepare("SELECT MAX(block_orderliness) FROM blocks WHERE link_id = :link_id");
			$statement->bindValue(":link_id", $link_id);
			$statement->execute();
			$maxOrderliness = $statement->fetchColumn();
			if($maxOrderliness !== false) 
			{
				$statement = $this->db->prepare("INSERT INTO blocks SET 
					user_id = :user_id, 
					link_id = :link_id,
					block_type = :block_type,
					block_orderliness = :block_orderliness
				");
				$statement->bindValue(":user_id", $user_id);
				$statement->bindValue(":link_id", $link_id);
				$statement->bindValue(":block_type", $block_type);
				$statement->bindValue(":block_orderliness", $maxOrderliness + 1);
				$statement->execute();

				return true;
			}
		}
		else
		{	
			return false;
		}

	}

	public function deleteBlock($block_id) 
	{
		$statement = $this->db->prepare("SELECT * FROM blocks WHERE block_id = :block_id");
		$statement->bindValue(":block_id", $block_id);
		$statement->execute();
		if($statement->rowCount() > 0) 
		{
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