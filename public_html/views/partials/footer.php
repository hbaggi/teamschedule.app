  <!-- Main Footer -->
  <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
          Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?= VENDOR_PATH; ?>jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= VENDOR_PATH; ?>bootstrap/5.3.2/js/bootstrap.min.js"></script>
  <script src="<?= VENDOR_PATH; ?>popper/popper.min.js"></script>
  <!-- jQuery UI -->
  <script src="<?= VENDOR_PATH; ?>jquery-ui/jquery-ui.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= ASSETS_PATH; ?>js/adminlte.min.js"></script>
  <!-- fullCalendar 2.2.5 -->
  <script src="<?= VENDOR_PATH; ?>moment/moment.min.js"></script>
  <script src='<?= VENDOR_PATH; ?>fullcalendar-6.1.10/dist/index.global.min.js'></script>
  <script src="<?= VENDOR_PATH; ?>fullcalendar-6.1.10/packages/bootstrap5/index.global.min.js"></script>
  <script src="<?= VENDOR_PATH; ?>fullcalendar-6.1.10/packages/core/locales-all.global.min.js"></script>

  <script>
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

                  // Receber o seletor da janela modal cadastrar
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

      });
  </script>

  <!-- Start Generic Script -->
  <script src="<?= VENDOR_PATH; ?>DataTables/datatables.js"></script>
  <script>
      $(document).ready(function() {
          $('#example').DataTable({
              language: {
                  lengthMenu: 'Exibindo _MENU_ registros por página',
                  zeroRecords: 'Nada para exibir',
                  info: 'Exibindo página _PAGE_ de _PAGES_',
                  infoEmpty: 'Nenhum registro disponível',
                  infoFiltered: '(filtrado de _MAX_ registros no total)',
                  search: 'Buscar',
                  //previous: 'Anterior',
                  //next: 'Próximo',
              },
          });
      });
  </script>
  <!-- End Generic Script -->

  <!-- Start Template Script -->
  <script src="<?= VENDOR_PATH; ?>daterangepicker/moment.min.js"></script>
  <script src="<?= VENDOR_PATH; ?>daterangepicker/daterangepicker.js"></script>
  <script>
      $(function() {
          'use strict';
          // Birth Date
          $('#birthDate').daterangepicker({
              singleDatePicker: true,
              showDropdowns: true,
              autoUpdateInput: false,
              maxDate: moment().add(0, 'days'),
          }, function(chosen_date) {
              $('#birthDate').val(chosen_date.format('MM-DD-YYYY'));
          });
      });
  </script>
  <!-- End Template Script -->

  <!-- Start companion script -->
  <script src="<?= VENDOR_PATH; ?>toastr-master/build/toastr.min.js"></script>
  <?php
    if (isset($_SESSION['success_message'])) {
        $message = htmlspecialchars($_SESSION['success_message'], ENT_QUOTES);
        echo '<script>toastr["success"](\'' . $message . '\')</script>';
        unset($_SESSION['success_message']);
        exit;
    }
    if (isset($_SESSION['info_message'])) {
        $message = htmlspecialchars($_SESSION['info_message'], ENT_QUOTES);
        echo '<script>toastr["info"](\'' . $message . '\')</script>';
        unset($_SESSION['info_message']);
        exit;
    }
    if (isset($_SESSION['error_message'])) {
        $message = htmlspecialchars($_SESSION['error_message'], ENT_QUOTES);
        echo '<script>toastr["error"](\'' . $message . '\')</script>';
        unset($_SESSION['error_message']);
        exit;
    }
    ?>
  <!-- End companion script -->

  <!-- Start custom script -->
  <script src="<?= ASSETS_PATH; ?>js/alert-lightweight-1.0.js"></script>
  <script src="<?= ASSETS_PATH; ?>js/select-lightweight-1.0.js"></script>
  <!-- End custom script -->

  <!-- Start browser back button simulator -->
  <script type="text/javascript">
      function simularBotaoVoltar() {
          window.history.back();
      }
  </script>
  <!-- End browser back button simulator -->

  <script>
      function doubleClick() {
          document.querySelector("#btn_create_event").disabled = true;
      }
  </script>



  </body>

  </html>