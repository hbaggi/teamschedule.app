<?php
/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
 */

class Core
{   // Função construct()
    public function __construct()
    {
        // Chama a função run()
        $this->run();
    }
    // Função run()
    public function run()
    {
        // Inicia a URL com uma barra como padrão
        $url = '/';

        // Verifica se há uma URL na requisição
        if (isset($_GET['url'])) {
            // Adiciona a URL à variável
            $url .= $_GET['url'];
        }

        // Cria um array para os parâmetros
        $params = array();

        // Se a URL não estiver vazia e for diferente de uma barra
        if (!empty($url) && $url != '/') {
            // Divide a URL em partes, separadas por barras
            $url = explode('/', $url);

            // Remove a primeira parte da URL (que é vazia)
            array_shift($url);

            // A primeira parte da URL é o nome do controller
            $currentController = $url[0] . 'Controller';

            // Remove a primeira parte da URL
            array_shift($url);

            // Se houver uma segunda parte na URL e ela não estiver vazia,
            // então essa é a action a ser executada. Caso contrário, usa "index" como padrão.
            if (isset($url[0]) && !empty($url[0])) {
                // Define o nome da função
                $currentFunction = $url[0];

                // Remove a primeira parte da URL
                array_shift($url);
            } else {
                // Usa "index" como padrão para a função
                $currentFunction = 'index';
            }

            // Se houver parâmetros adicionais na URL, adiciona-os à variável $params
            if (!empty($url)) {
                // Adiciona os parâmetros à variável $params
                $params = $url;
            }
        } else {
            // Se não houver nenhuma URL específica, usa o HomeController e a action "index"
            $currentController = 'HomeController';
            $currentFunction = 'index';
        }

        // Verifica se o controller e a action existem
        if (!file_exists('../controllers/' . ucfirst($currentController) . '.php') && !method_exists(ucfirst($currentController), $currentFunction)) {
            // Se não existirem, usa o NotFoundController e a action "index"
            $currentController = 'NotFoundController';
            $currentFunction = 'index';
        }

        // Cria uma instância do controller atual e chama a função correspondente com quaisquer parâmetros
        $c = new $currentController();
        call_user_func_array(array($c, $currentFunction), $params);

        // echo "<hr>";
        // echo "CONTROLLER: " . $currentController . "<br>";
        // echo "ACTION: " . $currentFunction . "<br>";
        // echo "PARAMS: " . print_r($params, true) . "<br>";
        // echo "<hr>";
        // echo URL_PATH . "<br>";
        // echo "<hr>";
    }
}
