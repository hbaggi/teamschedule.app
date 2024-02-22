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

class Upload extends Model
{
    public function uploadSeoImage($local, $seo_image)
    {

    	$filename = $local.$seo_image;

        $final_height = 100;
        $final_width = 100;

        list($original_width, $original_height) = getimagesize($filename);

        $ratio = $original_width / $original_height;

        if($final_width / $final_height > $ratio) 
        {
            $final_width = $final_height * $ratio;
        } 
        else 
        {
            $final_height = $final_width / $ratio;
        }

        $final_image = imagecreatetruecolor($final_width, $final_height);

        $type = mime_content_type($filename);

        if ($type == "image/jpeg")
        {
            $original_image = imagecreatefromjpeg($filename);
        }
        elseif ($type == "image/png")
        {
            $original_image = imagecreatefrompng($filename);
        }
        elseif ($type == "image/gif")
        {
            $original_image = imagecreatefromgif($filename);
        }

        imagecopyresampled(
            $final_image, $original_image, 
            0, 0, 
            0, 0, 
            $final_width, $final_height, 
            $original_width, $original_height
        );

        //header("Content-Type: image/jpeg");

        $new_filename = $filename;

        if ($type == "image/jpeg")
        {
            imagejpeg($final_image, $local.$new_filename, 70);
        }
        elseif ($type == "image/png")
        {
            imagepng($final_image, $local.$new_filename);
        }
        elseif ($type == "image/gif")
        {
            imagegif($final_image, $local.$new_filename);
        }

				
        //return $local;
    }

}








