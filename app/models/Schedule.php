<?php

/**
 * A lightweight PHP MVC Framework.
 * 
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BTECH. All rights reserved.
 * @link http://baggitech.com.br
 */


class Schedule extends Model
{
    public function getEvents()
    {
        $array = array();
        $statement = $this->db->prepare("SELECT id, title, color, start, end FROM events");
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $array = $result;
        }
        return $array;
    }

    public function getEventsByUserID($user_id)
    {
        $array = array();
        $statement = $this->db->prepare("SELECT id, title, color, start, end FROM events WHERE user_id = :user_id");
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $array = $result;
        }
        return $array;
    }

    public function addEvent($title, $color, $start, $end, $user_id)
    {
        $statement = $this->db->prepare("INSERT INTO events SET 
				title = :title,
                color = :color,
                start = :start,
                end = :end,
                user_id = :user_id
			");
        $statement->bindParam(":title", $title, PDO::PARAM_STR);
        $statement->bindParam(":color", $color, PDO::PARAM_STR);
        $statement->bindParam(":start", $start, PDO::PARAM_STR);
        $statement->bindParam(":end", $end, PDO::PARAM_STR);
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $statement->execute();

        return true;
    }

    public function updateEvent($id, $title, $color, $start, $end)
    {
        $statement = $this->db->prepare("UPDATE events SET 
				title = :title,
                color = :color,
                start = :start,
                end = :end WHERE id = :id
			");
        $statement->bindValue("id", $id);
        $statement->bindValue(":title", $title);
        $statement->bindValue(":color", $color);
        $statement->bindValue(":start", $start);
        $statement->bindValue(":end", $end);
        $statement->execute();

        return true;
    }

    public function deleteEvent($event_id)
    {
        $statement = $this->db->prepare("SELECT * FROM events WHERE id = :event_id");
        $statement->bindValue(":event_id", $event_id);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $statement = $this->db->prepare("DELETE FROM events WHERE id = :event_id");
            $statement->bindValue(":event_id", $event_id);
            $statement->execute();

            return true;
        } else {
            return false;
        }
    }

    public function getEventById($event_id)
    {
        $array = array();
        $statement = $this->db->prepare("SELECT * FROM events WHERE id = :event_id");
        $statement->bindValue(":event_id", $event_id);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $array = $result;

            $_SESSION['event_id'] = $result['event_id'];
        }
        return $array;
    }
}
