<?php/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
 */

class CodeGenerate extends Model
{
	public function generatingCode($size, $uppercase, $lowercase, $number, $symbol)
	{
		$generatedcode = "";
		
		// $up contem as letras maiúsculas
		$up = "ABCDEFGHIJKLMNOPQRSTUVYXWZ";

		// $low contem as letras minúsculas 
	    $low = "abcdefghijklmnopqrstuvyxwz";

	    // $num contem os números 
		$num = "0123456789";

		// $sym contem os símbolos 
		$sym = "!@#$%¨&*()_+="; 

		if ($uppercase)
		{
		    // se $uppercase for "true", a variável $up é 
		    // embaralhada e adicionada para a variável $generatedcode
		    $generatedcode .= str_shuffle($up);
		}
	    if ($lowercase)
	    {
			// se $lowercase for "true", a variável $low é 
			// embaralhada e adicionada para a variável $generatedcode
			$generatedcode .= str_shuffle($low);
		}
		if ($number)
		{
			// se $number for "true", a variável $num é 
			// embaralhada e adicionada para a variável $generatedcode
			$generatedcode .= str_shuffle($num);
		}
		if ($symbol)
		{
			// se $symbol for "true", a variável $sym é 
			// embaralhada e adicionada para a variável $generatedcode
			$generatedcode .= str_shuffle($sym);
		}
		// retorna a variável $generatedcode embaralhada com "str_shuffle" 
		// com o tamanho definido pela variável $size
		return substr(str_shuffle($generatedcode),0,$size);
		//COMO USAR
		//generatingCode(6, false, false, true, false);
	}
}