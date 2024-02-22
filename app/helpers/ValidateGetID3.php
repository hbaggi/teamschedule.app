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

class ValidateGetID3 extends Model
{
    public function validatingGetID3($target_file)
    {
        // Verificar se o arquivo é um arquivo de áudio ou vídeo válido
        require_once (__DIR__.'/../vendor/getID3-master/getid3/getid3.php');
        
        $getID3 = new getID3();
        $file_info = $getID3->analyze($target_file);

        if (isset($file_info['fileformat']) && $file_info['fileformat'] === 'mp3') 
        {
            // O arquivo é um arquivo de áudio ou vídeo válido
            // Faça as verificações adicionais necessárias ou retorne true
            return true;
        } 
        else 
        {
            // O arquivo não é um arquivo de áudio ou vídeo válido
            return false;
        }
    }

}    