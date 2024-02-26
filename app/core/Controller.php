<?php

/**
 * A lightweight PHP MVC Framework.
 *
 * @author Lázaro Baggi
 * @copyright Lázaro Baggi - BAGGITECH. All rights reserved.
 * @link https://github.com/hbaggi/teamschedule.app.git
 */

class Controller
{
    /**
     * Carrega uma view simples.
     *
     * @param string $viewName Nome da view a ser carregada.
     * @param array $viewData Dados opcionais a serem usados na view.
     */
    public function loadView($viewName, $viewData = array())
    {
        // Extrai os dados da view e os torna variáveis disponíveis.
        extract($viewData);

        // Carrega a view.
        require_once __DIR__ . '/../../public_html/views/' . $viewName . '.php';
    }

    /**
     * Carrega um template que contém uma view.
     *
     * @param string $viewName Nome da view a ser carregada.
     * @param array $viewData Dados opcionais a serem usados na view.
     */
    public function loadTemplate($viewName, $viewData = array())
    {
        // Extrai os dados da view e os torna variáveis disponíveis.
        extract($viewData);

        // Carrega o template que envolve a view.
        require_once __DIR__ . '/../../public_html/views/wrapper.php';
    }

    /**
     * Carrega uma view dentro de um template.
     *
     * @param string $viewName Nome da view a ser carregada.
     * @param array $viewData Dados opcionais a serem usados na view.
     */
    public function loadViewInTemplate($viewName, $viewData = array())
    {
        // Extrai os dados da view e os torna variáveis disponíveis.
        extract($viewData);

        // Carrega a view dentro do template.
        require_once __DIR__ . '/../../public_html/views/' . $viewName . '.php';
    }
}
