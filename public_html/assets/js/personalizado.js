
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    // Instanciar FullCalendar.Calendar e atribuir a variável calendar
    var calendar = new FullCalendar.Calendar(calendarEl, {

        // Incluindo o Bootstrap 5
        themeSystem: 'bootstrap5',

        // Criar cabeçalho do calendário	
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        // Definir o idioma usado no calendário
        locale: 'pt-br',

        // Definir a data inicial
        //initialDate: '2024-01-07',

        // can click day/week names to navigate views
        navLinks: true,

        // Permitir clicar e arrastar o mouse sobre um ou varios dias no calendário
        selectable: true,

        // Indicar visualmente a área que será selecionada antes que o usuário
        // solte o botão do mouse para confirmar a seleção
        selectMirror: true,

        select: function(arg) {
            var title = prompt('Event Title:');
            if (title) {
                calendar.addEvent({
                    title: title,
                    start: arg.start,
                    end: arg.end,
                    allDay: arg.allDay
                })
            }
            calendar.unselect()
        },
        eventClick: function(arg) {
            if (confirm('Are you sure you want to delete this event?')) {
                arg.event.remove()
            }
        },

        // Permitir arrastar e redimensionar os eventos diretamente no calendário.
        editable: true,

        // Número máximo de eventos em um determinado dia, se for true, o número de
        // eventos será limitado à altura da celula do dia
        dayMaxEvents: true,

        // Chamar o arquivo PHP para recuperar o evento
        events: <?php echo json_encode($events_user); ?>,

        // Indentificar o clique do usuário sobre o evento
        eventClick: function(info) {

            // Receber o seletor da janela modal visualizar
            const view_event_modal = new bootstrap.Modal(document.getElementById("view_event_modal"));

            // Enviar para a janela modal os dados do evento
            document.getElementById("viewevent_id").innerText = info.event.id;
            document.getElementById("viewevent_title").innerText = info.event.title;
            document.getElementById("viewevent_start").innerText = info.event.start.toLocaleString();
            document.getElementById("viewevent_end").innerText = info.event.end !== null ? info.event.end.
            toLocaleString(): info.event.start.toLocaleString();

            // Enviar os dados do evento para o formulário editar
            document.getElementById("edit_id").value = info.event.id;
            document.getElementById("edit_title").value = info.event.title;
            document.getElementById("edit_color").value = info.event.backgroundColor;
            document.getElementById("edit_start").value = converterData(info.event.start);
            document.getElementById("edit_end").value = info.event.end !== null ? converterData(info.event.end) : converterData(info.event.start);

            // Abrir a janela modal visualizar
            view_event_modal.show();

        },

        // Abrir a janela modal cadastrar quando clicar sobre o dia no calendário
        select: function(info) {

            // Receber o seletor da janela modal cadstar
            const create_event_modal = new bootstrap.Modal(document.getElementById("create_event_modal"));

            // Chamar a função para converter a data selecionada para ISO8601 e 
            // enviar para o formulário
            document.getElementById("cad_start").value = converterData(info.start);
            document.getElementById("cad_end").value = converterData(info.end);

            // Abrir a janela modal cadastrar
            create_event_modal.show();

        },

    });

    // Renderizar o calendário
    calendar.render();

    // Converter a data
    function converterData(data) {

        // Converter a string em um objeto Date
        const dataObj = new Date(data);

        // Extrair o ano da data
        const ano = dataObj.getFullYear();

        // Obter o mês, mês começa de 0, padStart adiciona zeros à esquerda para garantir que o mês tenha dígitos
        const mes = String(dataObj.getMonth() + 1).padStart(2, '0');

        // Obter o dia do mês, padStart adiciona zeros à esquerda para garantir que o dia tenha dois dígitos
        const dia = String(dataObj.getDate()).padStart(2, '0');

        // Obter a hora, padStart adiciona zeros à esquerda para garantir que a hora tenha dois dígitos
        const hora = String(dataObj.getHours()).padStart(2, '0');

        // Obter minuto, padStart adiciona zeros à esquerda para garantir que o minuto tenha dois dígitos
        const minuto = String(dataObj.getMinutes()).padStart(2, '0');

        // Retornar a data
        return `${ano}-${mes}-${dia} ${hora}:${minuto}`;
    }

    //Receber o SELETOR do formulário cadastrar evento
    const form_create_event = document.getElementById("form_create_event");

    // Receber o SELETOR da mensagem genérica
    //const msg = document.getElementById("msg");

    // Receber o SELETOR do botão da janela modal cadastar evento
    const btn_create_event = document.getElementById("btn_create_event");

    //Somente acessa o IF quando existir o SELETOR (form_create_event)    
    if (form_create_event) {

        //Aguardar o usuário clicar no botão para cadastrar um evento
        form_create_event.addEventListener("submit", async (e) => {

            //Não permitir a atualização da página
            //e.preventDefault();

            // Apresentar no botão o texto (Salvando...)
            btn_create_event.value = "Salvando...";

            //Receber os dados do formulário
            const dadosForm = new FormData(form_create_event);

            // Chamar o arquivo PHP responsável por salvar o evento
            const dados = await fetch("schedule/create", {
                method: "POST",
                body: dadosForm
            });

            //Realizar a leitura dos dados retornados pelo PHP
            const resposta = await dados.json();
            console.log(resposta);

            //Acessa o IF quando não editar com sucesso
            if (!resposta['status']) {
                // Enviar a mensagem para o HTML
                document.getElementById("msg_create_event").innerHTML = `<div class=" alert alert-danger" 
                role="alert">${resposta['msg']}</div>`;
            } else {
                msg.innerHTML = `<div class=" alert alert-success" 
                role="alert">${resposta['msg']}</div>`
            }

            // Apresentar no botão o texto (Cadastrar)
            btn_create_event.value = "Salvando...";

        });

    }

    // Receber o SELETOR ocultar detalhes do evento e apresentar o formulário editar evento
    const btn_view_edit_event = document.getElementById("btn_view_edit_event");

    // Somente acessa o if se existir o seletor (btn_view_edit_event)
    if (btn_view_edit_event) {
        // Aguardar o usuário clicar no botão
        btn_view_edit_event.addEventListener("click", () => {

            // Ocultar os detalhesdo evento
            document.getElementById("view_event").style.display = "none";
            document.getElementById("view_event_modal_label").style.display = "none";

            // Apresentar o formulário editar do evento
            document.getElementById("edit_event").style.display = "block";
            document.getElementById("edit_event_modal_label").style.display = "block";

        });
    }

    // Receber o SELETOR ocultar formulario e apresentar os detalhes do evento
    const btn_view_event = document.getElementById("btn_view_event");

    // Somente acessa o if se existir o seletor (btn_view_event)
    if (btn_view_event) {
        // Aguardar o usuário clicar no botão
        btn_view_event.addEventListener("click", () => {

            // Apresentar os detalhes do evento
            document.getElementById("view_event").style.display = "block";
            document.getElementById("view_event_modal_label").style.display = "block";

            // Ocultar o formulário do evento
            document.getElementById("edit_event").style.display = "none";
            document.getElementById("edit_event_modal_label").style.display = "none";

        });
    }

    // Receber o SELETOR apagar evento
    const btn_delete_event = document.getElementById("btn_delete_event");

    // Somente acessa o IF quando existir o SELETOR (form_edit_event)
    if (btn_delete_event) {

        // Aguardar o usuário clicar no botão apagar
        btn_delete_event.addEventListener("click", async () => {

            // Exibir uma caixa de diálogo de confirmação
            const confirmation = window.confirm("Tem certeza que deseja apagar este evento?");

            // Verificar se o usuário confirmou
            if (confirmation) {
                // Lógica de exclusão aqui (por exemplo, chamar uma função que exclui o registro do banco)
                // deleteRecord();
                //console.log("Registro apagado com sucesso!");
                return true;
            } else {
                //console.log("A exclusão foi cancelada pelo usuário.");
                return false;
            }

        });
    }

});
