<?php

$arquivo = "../../uploads/".$final_name;

$width = 200;
$height = 200;

	list($largura_original, $altura_original) = getimagesize($arquivo);

	$ratio = $largura_original / $altura_original;

	if($width / $height > $ratio) 
	{
		$width = $height * $ratio;
	} 
	else 
	{
		$height = $width / $ratio;
	}
			
	$imagem_final = imagecreatetruecolor($width, $height);

	$tipo = mime_content_type($arquivo);

	if ($tipo == "image/jpeg") 
	{
		$imagem_original = imagecreatefromjpeg($arquivo);
	}
	else if ($tipo == "image/png") 
	{
		$imagem_original = imagecreatefrompng($arquivo);
	}
	else if ($tipo == "image/gif") 
	{
		$imagem_original = imagecreatefromgif($arquivo);
	}

	//Cria a imagem que ficará acima do fundo	
	$imagem_final = imagecreatetruecolor($width, $height); 
	$fundo = imagecolorallocate($imagem_final, 255, 255, 255);

	//Muda a cor de fundo da imagem
	imagefill($imagem_final, 0, 0, $fundo); 		
	imagecopyresampled($imagem_final, $imagem_original, 0, 0, 0, 0, $width, $height, $largura_original, $altura_original);

	//Junta as duas imagens
	imagecopymerge($imagem_original, $imagem_final, 0, 0, 0, 0, $width, $height, 100); 


	if ($tipo == "image/jpeg") 
	{
		$local="../../uploads/$final_name";
		imagejpeg($imagem_final, $local, 70);
	} 
	else if ($tipo == "image/png") 
	{
		$local="../../uploads/$final_name";
		imagepng($imagem_final, $local);
	} 
	else if ($tipo == "image/gif") 
	{
		$local="../../uploads/$final_name";
		imagegif($imagem_final, $local);
	}
			
?>
