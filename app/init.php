<?php

/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BTECH. All rights reserved.
 * @link http://baggitech.com.br
 */

// Define o nível de exibição de erros como E_ALL, incluindo avisos, erros e notificações
// esta linha deve ser removida em um ambiente de produção.
ini_set('error_reporting', E_ALL);

// Define o fuso horário padrão utilizado pela aplicação.
date_default_timezone_set('America/Sao_Paulo');

// Esta função é responsável por determinar a URL base de da aplicação web. 
function getBaseUrl()
{
    // Verifica se a conexão com a aplicação é segura.
    $base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) === 'on' ? 'https' : 'http';

    // Obtém o nome do host (domínio) da aplicação.
    $base_url .= '://' . $_SERVER['HTTP_HOST'];

    // Obtém o caminho completo do script em execução, incluindo o nome do arquivo.
    $script_name = $_SERVER['SCRIPT_NAME'];

    // Remove o nome do arquivo do caminho, deixando apenas o diretório.
    $directory = str_replace(basename($script_name), '', $script_name);

    // Adaptação para lidar com reescrita de URL que oculta 'public_html'.
    $directory = str_replace('public_html/', '', $directory);

    // Concatena o diretório ao URL base para obter a URL completa da aplicação.
    $base_url .= $directory;

    return $base_url;
}

// Chama a função para obter a URL base da aplicação e a armazena em $base_url.
$base_url = getBaseUrl();

// Informações do sistema
define('SOFTWARE_NAME', 'Agenda CTI SAEB');
define('SOFTWARE_AUTHOR', 'Lázaro Baggi');
define('SOFTWARE_URL', '#');
define('SOFTWARE_VERSION', '1.0');

// Define a constante URL_PATH com o caminho base da aplicação.
define('URL_PATH', $base_url);
define('ASSETS_PATH', $base_url . 'assets/');
define('VENDOR_PATH', $base_url . 'vendor/');
define('UPLOADS_PATH', $base_url . 'uploads/');
define('COOKIE_PATH', preg_replace('|https?://[^/]+|i', '', URL_PATH));

// Verifica se a sessão já está ativa
if (session_status() !== PHP_SESSION_ACTIVE) {
    // Define as configurações do cookie de sessão
    $options = [
        'lifetime' => null,
        'path' => COOKIE_PATH,
        //'domain' => $base_url,
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ];

    session_set_cookie_params($options);

    // Inicia a sessão
    ob_start();
    session_start();
}

// Como a variável $base_url não é mais necessária após a definição 
// da constante remove-se a variável não utilizada.
unset($base_url);

// -------------------------------------------------------------------

// Define constantes para a raiz dos diretórios
define('CORE_DIR', __DIR__ . '/core/');
define('MODELS_DIR', __DIR__ . '/models/');
define('HELPERS_DIR', __DIR__ . '/helpers/');
define('INCLUDES_DIR', __DIR__ . '/includes/');
define('CONTROLLERS_DIR', __DIR__ . '/controllers/');
define('VENDOR_DIR', __DIR__ . '/vendor/');

// Cria um array para armazenar as classes já carregadas
$loaded_classes = array();

// Registra um autoloader personalizado para a aplicação
spl_autoload_register(function ($class) use (&$loaded_classes) {
    // Verifica se a classe já foi carregada
    if (isset($loaded_classes[$class])) {
        return;
    }

    // Cria um array com os diretórios definidos acima
    $dirs = array(
        CORE_DIR,
        MODELS_DIR,
        HELPERS_DIR,
        INCLUDES_DIR,
        CONTROLLERS_DIR,
        VENDOR_DIR
    );

    // Percorre os diretórios e subdiretórios em busca da classe
    foreach ($dirs as $dir) {
        $file = $dir . $class . '.php';

        // Verifica se o caminho do arquivo é válido
        if (is_file($file)) {
            if (file_exists($file)) {
                require_once $file;
                break;
            }
        }
    }

    // Adiciona a classe carregada ao array
    $loaded_classes[$class] = true;
});
