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

// Importação das classes do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailManager extends Model
{
	/**
	 * Credenciais de acesso ao SMTP
	 * @var string
	 */
	const HOST 		= 'mail.poptag.app';
	const USER 		= 'contato@poptag.app';
	const PASS 		= 'hb@@281033';
	const SECURE 	= 'TLS';
	const PORT 		= 465;
	const CHARSET 	= 'UTF-8';

	// CONFIGURAÇÕES OUTLOOK
	// const HOST     = 'smtp.office365.com'; // Servidor SMTP do Outlook para Office 365
	// const USER     = 'seu_email@dominio.com'; // Seu endereço de e-mail do Outlook
	// const PASS     = 'sua_senha'; // Sua senha do Outlook
	// const SECURE   = 'tls'; // Pode ser 'ssl' ou 'tls', dependendo da configuração do seu servidor
	// const PORT     = 587; // Porta SMTP para o Outlook
	// const CHARSET  = 'UTF-8'; // Conjunto de caracteres, geralmente 'UTF-8'

	// CONFIGURAÇÕES GMAIL
	// const HOST     = 'smtp.gmail.com'; // Servidor SMTP do Gmail
	// const USER     = 'baggitech@gmail.com'; // Seu endereço de e-mail do Gmail
	// const PASS     = 'LBcpae@@472023'; // Sua senha do Gmail ou senha de aplicativo, se a autenticação de dois fatores estiver ativada
	// const SECURE   = 'tls'; // Use 'tls' ou 'ssl' dependendo da configuração do seu servidor
	// const PORT     = 587; // Porta SMTP para o Gmail
	// const CHARSET  = 'UTF-8'; // Conjunto de caracteres, geralmente 'UTF-8'



	/**
	 * Dados do remetente
	 * @var string
	 */
	const FROM_EMAIL = 'contato@poptag.app';
	const FROM_NAME	 = 'PopTag';

	/**
	 * E-mail de resposta
	 * @var string
	 */
	const REPLY_TO = 'noreply@poptag.app';

	/**
	 * Mensagem de erro do envio
	 * @var string
	 */
	private $error;

	/**
	 * Método responsável por retornar a mensagem de erro do envio
	 * @return string
	 */
	public function getError()
	{
		return $this->error;
	}

	/**
	 * Método responsável por enviar um email
	 *
	 * @param string/array $addresses Lista de endereços de e-mail dos destinatários
	 * @param string $subject Assunto do e-mail
	 * @param string $body Corpo do e-mail em formato HTML
	 * @param string/array $attachments Lista de caminhos para anexos
	 * @param string/array $ccs Lista de endereços de e-mail para Cc (cópias)
	 * @param string/array $bccs Lista de endereços de e-mail para Bcc (cópias ocultas)
	 *
	 * @return boolean Retorna verdadeiro se o e-mail for enviado com sucesso, caso contrário, retorna falso
	 */
	public function sendEmail($addresses, $subject, $body, $attachments = [], $ccs = [], $bccs = [])
	{
		// LIMPAR A MENSAGEM DE ERRO
		$this->error = '';

		// Inclusão das classes necessárias do PHPMailer
		require_once __DIR__ . '/../vendor/PHPMailer-master/src/PHPMailer.php';
		require_once __DIR__ . '/../vendor/PHPMailer-master/src/SMTP.php';
		require_once __DIR__ . '/../vendor/PHPMailer-master/src/Exception.php';

		// Instância do PHPMailer
		$mail = new PHPMailer(true);

		try {
			// Configuração das credenciais de acesso ao SMTP
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Habilita a saída de depuração detalhada
			$mail->isSMTP(true);
			$mail->Host 		= self::HOST;
			$mail->SMTPAuth 	= true;
			$mail->Username 	= self::USER;
			$mail->Password 	= self::PASS;
			$mail->SMTPSecure 	= PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port 		= self::PORT;
			$mail->CharSet 		= self::CHARSET;

			// Configuração do remetente
			$mail->setFrom(self::FROM_EMAIL, self::FROM_NAME);

			// Configuração dos destinatários
			$addresses = is_array($addresses) ? $addresses : [$addresses];
			foreach ($addresses as $address) {
				$mail->addAddress($address);
			}

			// Configuração dos anexos
			$attachments = is_array($attachments) ? $attachments : [$attachments];
			foreach ($attachments as $attachment) {
				$mail->addAttachment($attachment);
			}

			// Configuração do e-mail de resposta
			$mail->addReplyTo(self::REPLY_TO, 'Não responder');

			// Configuração das Cc (cópias)
			$ccs = is_array($ccs) ? $ccs : [$ccs];
			foreach ($ccs as $cc) {
				$mail->addCC($cc);
			}

			// Configuração das Bcc (cópias ocultas)
			$bccs = is_array($bccs) ? $bccs : [$bccs];
			foreach ($bccs as $bcc) {
				$mail->addBCC($bcc);
			}

			// Configuração do conteúdo do e-mail como HTML
			$mail->isHTML(true);

			// Configuração do assunto do e-mail
			$mail->Subject = $subject;

			// Configuração do corpo do e-mail em formato HTML
			$mail->Body = $body;

			// Configuração do corpo do e-mail sem HTML
			//$mail->AltBody = $body;

			// Envio do e-mail
			return $mail->send();
		} catch (Exception $e) {
			// Captura de exceções e armazenamento da mensagem de erro
			$this->error = $e->getMessage();
			return false;
		}
	}
}
