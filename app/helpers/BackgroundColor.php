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

class BackgroundColor extends Model
{
	public function getColor($background) 
	{
		$color["zero"] 	= "",
		$color["one"]  	= "111.7deg, #a529b9 19.9%, #50b1e1 95%";
		$color["two"]  	= "109.6deg, #ffb418 11.2%, #f73131 91.1%";
		$color["three"] = "135deg, #79F1A4 10%, #0E5CAD 100%";
		$color["four"] 	= "to bottom, #ff758c, #ff7eb3";
		$color["five"] 	= "292.2deg, #3355ff 33.7%, #0088ff 93.7%";
		$color["six"] 	= "to bottom, #fc5c7d, #6a82fb";
		$color["seven"] = "135deg, #414345, #232526";
		$color["eight"] = "135deg, #44A08D, #093637";

		foreach ($color as $value) 
		{
			$color = $value['color'];
		}

		return $color;
	}
}