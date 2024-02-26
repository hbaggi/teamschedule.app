<?php
/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
 */

class DatabaseConnection
{
    private PDO $db;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            // Configuração das opções para a conexão PDO
            $options = [
                // Impede a emulação de consultas preparadas
                PDO::ATTR_EMULATE_PREPARES => false,
                // Lança exceções em caso de erros
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // Define o modo padrão de retorno como um array associativo
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // Define o conjunto de caracteres e a colação de caracteres a serem usados
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
            ];

            // Configuração da string de conexão com o banco de dados
            $dsn = sprintf('%s:host=%s;dbname=%s', DB_DRIVER, DB_HOST, DB_NAME);

            // Criação de uma instância da classe PDO com a string de conexão e as opções
            $this->db = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Tratamento de exceção em caso de erro na conexão
            die("Connection error: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->db;
    }
}
