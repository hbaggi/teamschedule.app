  <!-- Content -->
  <div id="content">
    <div class="container py-5">
      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">

          <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">

            <h3 class="text-center mb-4">Redefinir Senha</h3>

            <hr class="mx-n3 mx-sm-n5">

            <p class="lead text-4 text-center"></p>

            
            <form action="" method="POST">

              <input type="hidden" name="token" value="<?=$_SESSION['csrf_token'];?>" readonly>
              <input type="hidden" name="form_recovery_pass" readonly>

              <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" value="<?=$_SESSION['email'];?>" placeholder="Digite o email cadastrado" readonly>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Nova Senha</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Digite uma nova Senha">
              </div>

              <div class="mb-3">
                <label for="confirm_password" class="form-label">Repetir Senha</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirme sua nova Senha">
              </div>

              <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Redefinir senha</button>
              </div>
              
            </form>

            <p class="text-3 text-muted text-center mb-0">Voltar para o  
              <a class="btn-link" href="<?=URL_PATH;?>signin">Login!</a>
            </p>

          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- Content end --> 
