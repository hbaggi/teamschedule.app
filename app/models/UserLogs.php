<?php

/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
 */

class UserLogs extends Model
{
	public function getUserLogs($user_id, $type)
	{
		$detect = new MobileDetect();
		$country = new CountryCode();

		$statement = $this->db->prepare("INSERT INTO logs SET
			user_id = :user_id,
			type = :type, 
			ip = :ip,
			device_type = :device_type,
			os_name = :os_name,
			country_code = :country_code,
			date_time = :date_time
		");
		$statement->bindValue(":user_id", $user_id);
		$statement->bindValue(":type", $type);
		$statement->bindValue(":ip", $_SERVER['REMOTE_ADDR']);
		$statement->bindValue(":device_type", $detect->isMobile() ? "Mobile" : "Desktop");
		$statement->bindValue(":os_name", $_SERVER['HTTP_USER_AGENT']);
		$statement->bindValue(":country_code", $country->getCountryCode());
		$statement->bindValue(":date_time", date("Y-m-d H:i:s"));
		$statement->execute();

		return true;
	}
}
