<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda CTI SAEB | Log in</title>


    <!-- Start Vendor Generic Style -->
    <link rel="stylesheet" type="text/css" href="<?= VENDOR_PATH; ?>bootstrap/5.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= VENDOR_PATH; ?>DataTables/datatables.css" />
    <link rel="stylesheet" type="text/css" href="<?= VENDOR_PATH; ?>owl.carousel/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= VENDOR_PATH; ?>bootstrap-select/css/bootstrap-select.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= VENDOR_PATH; ?>daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?= VENDOR_PATH; ?>toastr-master/build/toastr.css" />
    <!-- End Vendor Generic Style -->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= VENDOR_PATH; ?>fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= VENDOR_PATH; ?>icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= ASSETS_PATH; ?>css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Agenda </b>CTI SAEB</a>
        </div>

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ativação</p>

                <form action="" method="POST">

                    <input type="hidden" name="token" value="<?= $_SESSION['csrf_token']; ?>" readonly>
                    <input type="hidden" name="form_verify" readonly>

                    <div class="input-group mb-3">
                        <input type="text" name="code_verify" id="code_verify" class="form-control" value="" placeholder="Código">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-check"></span>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Ativar conta</button>
                    </div>
                </form>

                <p class="mb-1">
                    <a href="recovery">Esqueci minha senha</a>
                </p>
                <p class="mb-0">
                    <a href="signup" class="text-center">Registrar uma nova conta</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>

    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= VENDOR_PATH; ?>jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= VENDOR_PATH; ?>bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= ASSETS_PATH; ?>js/adminlte.min.js"></script>

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
    <script src="<?= VENDOR_PATH; ?>owl.carousel/owl.carousel.min.js"></script>
    <script src="<?= VENDOR_PATH; ?>imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?= VENDOR_PATH; ?>bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="<?= VENDOR_PATH; ?>jquery-countdown/jquery.countdown.min.js"></script>
    <script src="<?= ASSETS_PATH; ?>js/theme.js"></script>
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

</body>

</html>