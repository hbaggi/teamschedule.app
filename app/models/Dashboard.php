<?php

/**
 * A lightweight PHP MVC Framework.
 * 
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BTECH. All rights reserved.
 * @link http://baggitech.com.br
 */


class Dashboard extends Model
{

    public function getAllLinksByUserID($user_id) 
    {
        $result = '';
        $statement = $this->db->prepare("SELECT * FROM links WHERE user_id = :user_id");
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        if($statement->rowCount() > 0) 
        {
            $result = $statement->rowCount();
        }
        
        return $result;
    }
    

    public function getAllQRCodesByUserID($user_id) 
    {
        $result = '';
        $statement = $this->db->prepare("SELECT * FROM qrcodes WHERE user_id = :user_id");
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        if($statement->rowCount() > 0) 
        {
            $result = $statement->rowCount();
        }
        
        return $result;
    }


}