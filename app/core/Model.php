<?php/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
 */

class Model
{
    protected PDO $db;

    public function __construct()
    {
        // Cria uma instância da classe de conexão com o banco de dados
        $databaseConnection = new DatabaseConnection();
        
        // Obtém a conexão PDO do objeto de conexão
        $this->db = $databaseConnection->getConnection();
    }
}

// Utilize a classe Model
// $model = new Model();
// Agora, a propriedade $db contém a conexão PDO e pode ser utilizada para 
// executar consultas no banco de dados.