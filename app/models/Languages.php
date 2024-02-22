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

class Languages extends Model
{
    public function getLanguage() 
    {
        $array = array();
        $statement = $this->db->prepare("SELECT * FROM languages");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) 
        {
            $array[$row['prefix']] = $row['pt'];
        }

        return $array;
    }
}

