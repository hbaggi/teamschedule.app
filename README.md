# Agenda em PHP com MVC, PDO e FullCalendar

Este projeto representa uma aplicação de agenda desenvolvida em PHP, utilizando a arquitetura MVC (Model-View-Controller) e o PDO para interação com o banco de dados. A aplicação é projetada especificamente para atender às necessidades da SAEB/CTI Coordenação de Tecnologia da Informação, combinando eficiência e facilidade de uso.

Pré-requisitos
Certifique-se de ter os seguintes requisitos instalados antes de começar:

Servidor web (por exemplo, Apache)
PHP 7.x ou superior
MySQL ou outro banco de dados compatível com PDO
Configuração
Clone este repositório: git clone https://github.com/seu-usuario/agenda-php-mvc.git
Configure seu servidor web para apontar para o diretório do projeto.
Importe o arquivo database.sql no seu banco de dados para criar a tabela necessária.
Estrutura do Projeto
/app: Contém os arquivos relacionados à lógica de aplicação.

/controllers: Controladores PHP.
/models: Modelos PHP para interação com o banco de dados.
/views: Arquivos de visualização.
/public: Contém arquivos públicos acessíveis pelo navegador.

/css: Estilos CSS.
/js: Scripts JavaScript.
/lib: Bibliotecas de terceiros (por exemplo, FullCalendar).
/config: Configurações gerais do projeto.

Configuração do Banco de Dados
Edite o arquivo /config/config.php com as informações do seu banco de dados.
Importe o arquivo database.sql no seu banco de dados para criar a tabela necessária.
Uso
Acesse o projeto no seu navegador e explore a agenda interativa. Você pode adicionar, editar, excluir eventos e visualizá-los no plugin FullCalendar.

Tecnologias Utilizadas
PHP
MySQL (ou outro banco de dados compatível com PDO)
FullCalendar (https://fullcalendar.io/)
Bootstrap AdminLTE (https://adminlte.io/)
Contribuição
Sinta-se à vontade para contribuir com melhorias, correções de bugs ou novos recursos. Abra uma issue para discutir grandes alterações antes de enviar um pull request.

Licença
Este projeto está licenciado sob a licença MIT - veja o arquivo LICENSE.md para mais detalhes.
