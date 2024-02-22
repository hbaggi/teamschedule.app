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

class ValidatePix extends Model
{
	
	public function validatingCPF($cpf) 
	{
	    // Remover caracteres não numéricos
	    //$cpf = preg_replace('/[^0-9]/', '', $cpf);
	    
	    // Remove todos os caracteres não numéricos e espaços
	    $cpf = preg_replace('/[^0-9\s]/', '', $cpf);

		// Verifica o número de dígitos
		$numDigitos = strlen($cpf);
		if ($numDigitos < 11) 
		{
		  // Preenche com zeros à esquerda até ter 11 dígitos
		  $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		}

	    // Verificar se o CPF possui 11 dígitos
	    if (strlen($cpf) !== 11) 
	    {
	        return false;
	    }

	    // Verificar se todos os dígitos são iguais (CPF inválido)
	    if (preg_match('/^(\d)\1+$/', $cpf)) 
	    {
	        return false;
	    }

	    // Calcular os dígitos verificadores
	    $soma = 0;
	    for ($i = 0; $i < 9; $i++) 
	    {
	        $soma += ($cpf[$i] * (10 - $i));
	    }
	    $resto = $soma % 11;
	    $primeiroDigitoVerificador = ($resto < 2) ? 0 : (11 - $resto);

	    $soma = 0;
	    for ($i = 0; $i < 10; $i++) 
	    {
	        $soma += ($cpf[$i] * (11 - $i));
	    }
	    $resto = $soma % 11;
	    $segundoDigitoVerificador = ($resto < 2) ? 0 : (11 - $resto);

	    // Verificar se os dígitos verificadores estão corretos
	    if ($cpf[9] != $primeiroDigitoVerificador || $cpf[10] != $segundoDigitoVerificador) 
	    {
	        return false;
	    }

	    // Formatar CPF apenas com caracteres numéricos
	    $cpfFormatado = $cpf;

	    return $cpfFormatado;
	}

	public function validatingCNPJ($cnpj)
	{
	    // Remover caracteres não numéricos
	    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

	    // Verificar o número de dígitos
	    $numDigitos = strlen($cnpj);
	    if ($numDigitos != 14)
	    {
	        return false;
	    }

	    // Verificar se todos os dígitos são iguais (CNPJ inválido)
	    if (preg_match('/^(\d)\1+$/', $cnpj))
	    {
	        return false;
	    }

	    // Calcular o primeiro dígito verificador
	    $soma = 0;
	    $multiplicador = 5;
	    for ($i = 0; $i < 12; $i++)
	    {
	        $soma += $cnpj[$i] * $multiplicador;
	        $multiplicador = ($multiplicador == 2) ? 9 : ($multiplicador - 1);
	    }
	    $resto = $soma % 11;
	    $primeiroDigitoVerificador = ($resto < 2) ? 0 : (11 - $resto);

	    // Calcular o segundo dígito verificador
	    $soma = 0;
	    $multiplicador = 6;
	    for ($i = 0; $i < 13; $i++)
	    {
	        $soma += $cnpj[$i] * $multiplicador;
	        $multiplicador = ($multiplicador == 2) ? 9 : ($multiplicador - 1);
	    }
	    $resto = $soma % 11;
	    $segundoDigitoVerificador = ($resto < 2) ? 0 : (11 - $resto);

	    // Verificar se os dígitos verificadores estão corretos
	    if ($cnpj[12] != $primeiroDigitoVerificador || $cnpj[13] != $segundoDigitoVerificador)
	    {
	        return false;
	    }

	    // Formatar CNPJ apenas com caracteres numéricos
	    $cnpjFormatado = $cnpj;

	    return $cnpjFormatado;
	}

	public function validatingCellPhone($cellPhone) 
	{
	    // Remover todos os caracteres não numéricos do número de telefone
	    $cellPhone = preg_replace('/[^0-9]/', '', $cellPhone);

	    // Calcular o número de dígitos presentes no número de telefone
	    $numDigits = strlen($cellPhone);

	    // Verificar se o número de dígitos está fora da faixa esperada
	    if ($numDigits < 10 || $numDigits > 13) 
	    {
	      // O número de telefone é inválido, portanto retornar `false`
	      return false;
	    }

	    // Verificar se o número de dígitos corresponde a um número de telefone celular válido no Brasil
	    if ($numDigits == 10 || $numDigits == 11) 
	    {
	      // Adicionar o prefixo '55' ao número de telefone
	      $cellPhone = '+55' . $cellPhone;
	    } 
	    elseif ($numDigits == 12 || $numDigits == 13) 
	    {
	      // Remover o primeiro dígito e adicionar o prefixo '55' ao número de telefone
	      $cellPhone = '+55' . substr($cellPhone, 1);
	    }

	    // Retornar o número de telefone formatado
	    return $cellPhone;
	}

	public function sanitizeDescription($description) 
	{
	  // Remove acentos gráficos e caracteres especiais
	  $description = iconv('UTF-8', 'ASCII//TRANSLIT', $description);
	  $description = preg_replace('/[^A-Za-z0-9\s]/', '', $description);

	  // Remove espaços em excesso e trim
	  $description = preg_replace('/\s+/', ' ', $description);
	  $description = trim($description);

	  // Limita o número máximo de caracteres
	  $description = substr($description, 0, 140);

	  return $description;
	}

	public function sanitizeMerchantName($merchantName) 
	{
	  // Remove acentos gráficos e caracteres especiais
	  $merchantName = iconv('UTF-8', 'ASCII//TRANSLIT', $merchantName);
	  $merchantName = preg_replace('/[^A-Za-z0-9\s]/', '', $merchantName);

	  // Remove espaços em excesso e trim
	  $merchantName = preg_replace('/\s+/', ' ', $merchantName);
	  $merchantName = trim($merchantName);

	  // Limita o número máximo de caracteres
	  $merchantName = substr($merchantName, 0, 140);

	  return $merchantName;
	}

	public function sanitizeMerchantCity($merchantCity) 
	{
	  // Remove acentos gráficos e caracteres especiais
	  $merchantCity = iconv('UTF-8', 'ASCII//TRANSLIT', $merchantCity);
	  $merchantCity = preg_replace('/[^A-Za-z0-9\s]/', '', $merchantCity);
	  
	  // Remove espaços em excesso e trim
	  $merchantCity = preg_replace('/\s+/', ' ', $merchantCity);
	  $merchantCity = trim($merchantCity);

	  // Limita o número máximo de caracteres
	  $merchantCity = substr($merchantCity, 0, 60);

	  return $merchantCity;
	}

	public function sanitizeAmount($amount) 
	{

        //$amount = floatval($amount);
        //$amount = number_format($amount, 2, '.', '');

	  	// Remove caracteres especiais, exceto ponto decimal
	  	$amount = preg_replace('/[^0-9.]/', '', $amount);

	  	// Limita o número máximo de caracteres
	  	$amount = substr($amount, 0, 15);

	  	return $amount;
	}

}
