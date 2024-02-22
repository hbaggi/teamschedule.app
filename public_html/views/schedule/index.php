    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?= ucfirst($page); ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><?= ucfirst($page); ?></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <!-- <div class="col-md-12">
                        <?php //require_once(__DIR__ . '/../../../app/helpers/Alerts.php'); 
                        ?>
                    </div> -->

                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <!-- THE CALENDAR -->
                                <div id="calendar"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->





    <!-- Modal Register -->
    <div class="modal fade" id="create_event_modal" tabindex="-1" aria-labelledby="create_event_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="create_event_modal_label">Cadastrar evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <span id="msg_create_event"></span>

                    <form action="" method="POST" id="form_create_event" onsubmit="doubleClick()">

                        <input type="hidden" name="form_create_event">

                        <input type="hidden" name="token" value="<?= $_SESSION['csrf_token']; ?>" readonly>

                        <div class="row mb-3">
                            <label for="cad_title" class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="cad_title" id="cad_title" placeholder="Título do evento">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cad_start" class="col-sm-2 col-form-label">Início</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" name="cad_start" id="cad_start">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cad_end" class="col-sm-2 col-form-label">Fim</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" name="cad_end" id="cad_end">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cad_color" class="col-sm-2 col-form-label">Cor</label>
                            <div class="col-sm-10">
                                <select name="cad_color" id="cad_color" class="form-control">
                                    <option value="">Selecione</option>
                                    <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                    <option style="color:#0071C5;" value="#0071C5">Azul Turquesa</option>
                                    <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                    <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                                    <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                    <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                    <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                    <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                    <option style="color:#228B22;" value="#228B22">Verde</option>
                                    <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" name="btn_create_event" id="btn_create_event" class="btn btn-primary">Cadastrar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>





    <!-- Modal View -->
    <div class="modal fade" id="view_event_modal" tabindex="-1" aria-labelledby="view_event_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="view_event_modal_label">Detalhes do evento</h1>
                    <h1 class="modal-title fs-5" id="edit_event_modal_label" style="display: none;">Editar evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div id="view_event">
                        <dl class="row">
                            <dt class="col-sm-3">ID</dt>
                            <dd class="col-sm-9" id="viewevent_id"></dd>
                            <dt class="col-sm-3">Título</dt>
                            <dd class="col-sm-9" id="viewevent_title"></dd>
                            <dt class="col-sm-3">Início</dt>
                            <dd class="col-sm-9" id="viewevent_start"></dd>
                            <dt class="col-sm-3">Fim</dt>
                            <dd class="col-sm-9" id="viewevent_end"></dd>
                        </dl>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <form action="" method="POST">
                                <input type="hidden" name="form_delete_event">
                                <input type="hidden" name="token" value="<?= $_SESSION['csrf_token']; ?>" readonly>
                                <input type="hidden" name="id" id="targetInput">
                                <button type="submit" class="btn btn-danger" name="btn_delete_event" id="btn_delete_event" onclick="passValue()">Deletar</button>
                            </form>

                            <button type="button" name="btn_view_edit_event" id="btn_view_edit_event" class="btn btn-warning">Editar</button>
                        </div>

                    </div>

                    <div id="edit_event" style="display: none;">

                        <span id="msg_edit_event"></span>

                        <form method="POST" id="form_edit_event">
                            <input type="hidden" name="form_edit_event">
                            <input type="hidden" name="token" value="<?= $_SESSION['csrf_token']; ?>">
                            <input type="hidden" name="edit_id" id="edit_id">
                            <div class="row mb-3">
                                <label for="edit_title" class="col-sm-2 col-form-label">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="edit_title" id="edit_title" placeholder="Título do evento">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="edit_start" class="col-sm-2 col-form-label">Início</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" name="edit_start" id="edit_start">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="edit_end" class="col-sm-2 col-form-label">Fim</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" name="edit_end" id="edit_end">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="edit_color" class="col-sm-2 col-form-label">Cor</label>
                                <div class="col-sm-10">
                                    <select name="edit_color" id="edit_color" class="form-control">
                                        <option value="">Selecione</option>
                                        <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                        <option style="color:#0071C5;" value="#0071C5">Azul Turquesa</option>
                                        <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                        <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                                        <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                        <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                        <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                        <option style="color:#228B22;" value="#228B22">Verde</option>
                                        <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" name="btn_view_event" id="btn_view_event" class="btn btn-danger">Cancelar</button>
                                <button type="submit" name="btn_edit_event" id="btn_edit_event" class="btn btn-primary">Salvar</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function passValue() {
            // Pega o valor do elemento com o ID "sourceValue"
            var sourceValue = document.getElementById('viewevent_id').innerText;
            // Atribui o valor ao input com o ID "targetInput"
            document.getElementById('targetInput').value = sourceValue;
        }
    </script>