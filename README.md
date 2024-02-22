# Agenda em PHP com MVC, PDO e FullCalendar

Este projeto representa uma aplicação de agenda desenvolvida em PHP, utilizando a arquitetura MVC (Model-View-Controller) e o PDO para interação com o banco de dados. A aplicação é projetada especificamente para atender ao teste de cargo Tecnico em Desenvolvimento da SAEB/CTI Coordenação de Tecnologia da Informação.

## Pré-requisitos:<br>
Certifique-se de ter os seguintes requisitos instalados antes de começar:

Servidor web (por exemplo, Apache)<br>
PHP 7.x ou superior<br>
MySQL ou outro banco de dados compatível com PDO<br>

## Configuração:<br>
Clone este repositório: git clone https://github.com/seu-usuario/agenda-php-mvc.git<br>
Configure seu servidor web para apontar para o diretório do projeto.<br>
Importe o arquivo database.sql no seu banco de dados para criar a tabela necessária.<br>

## Estrutura do Projeto:<br>
/app: Contém os arquivos relacionados à lógica de aplicação.<br>

/controllers: Controladores PHP.<br>
/models: Modelos PHP para interação com o banco de dados.<br>
/views: Arquivos de visualização.<br>
/public: Contém arquivos públicos acessíveis pelo navegador.<br>

/css: Estilos CSS.<br>
/js: Scripts JavaScript.<br>
/lib: Bibliotecas de terceiros (por exemplo, FullCalendar).<br>
/config: Configurações gerais do projeto.<br>

## Configuração do Banco de Dados:<br>
Edite o arquivo /config/config.php com as informações do seu banco de dados.<br>
Importe o arquivo database.sql no seu banco de dados para criar a tabela necessária.<br>

## Uso:
Acesse o projeto no seu navegador e explore a agenda interativa. Você pode adicionar, editar, excluir eventos e visualizá-los no plugin FullCalendar.<br>

## Tecnologias Utilizadas:
PHP<br>
MySQL (ou outro banco de dados compatível com PDO)<br>
FullCalendar (https://fullcalendar.io/)<br>
Bootstrap AdminLTE (https://adminlte.io/)<br>

## Contribuição:
Sinta-se à vontade para contribuir com melhorias, correções de bugs ou novos recursos. Abra uma issue para discutir grandes alterações antes de enviar um pull request.

## Licença:
Este projeto está licenciado sob a licença MIT - veja o arquivo LICENSE.md para mais detalhes.
