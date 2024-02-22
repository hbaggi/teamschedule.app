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

class Captcha extends Model
{

    public function generatingCaptchaImage($captcha_code)
    {
        $layer = imagecreatetruecolor(168, 37);
        $captcha_bg = imagecolorallocate($layer, 165, 181, 197);
        imagefill($layer, 0, 0, $captcha_bg);
        $captcha_text_color = imagecolorallocate($layer, 0, 0, 0);
        imagestring($layer, 5, 55, 10, $captcha_code, $captcha_text_color);
        //header("Content-type: image/jpeg");
        $local = (__DIR__ . '/../../uploads/captcha/');
        imagejpeg($layer, $local . $captcha_code . '.jpeg', 70);

        return $captcha_code;
    }

    public function generatingCaptchaDB($captcha_code)
    {
        $statement = $this->db->prepare("SELECT * FROM captcha WHERE captcha_code = :captcha_code");
        $statement->bindValue(":captcha_code", $captcha_code);
        $statement->execute();
        if($statement->rowCount() == 0) 
        {
            $statement = $this->db->prepare("INSERT INTO captcha SET captcha_code = :captcha_code");
            $statement->bindValue(":captcha_code", $captcha_code);
            $statement->execute();

            return true;
        } 
        else 
        {


            return false;
        }
    }

}