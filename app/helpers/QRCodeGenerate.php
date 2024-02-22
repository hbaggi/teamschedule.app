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

class QRCodeGenerate extends Model
{

	public function generatingQRCode($qr_code_image, $qr_code_fields)
	{
		$image_size = 5; 
		$error_correction_level = 'H'; 
		$image_format = 'png'; 
		$upload_dir = __DIR__.'/../../public_html/uploads/biolinks/qrcodes/';

	    require_once __DIR__.'/../vendor/phpqrcode-master/qrlib.php';

	    $filename = $qr_code_image . '.' . $image_format;

	    QRcode::png($qr_code_fields, $upload_dir.$filename, $error_correction_level, $image_size);

	    return $filename;
	}
	
}