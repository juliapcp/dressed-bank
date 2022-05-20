<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php if (\Config\Services::validation()->getErrors()) {
?>
  <div class="alert alert-danger" role="alert">
    <?= \Config\Services::validation()->listErrors(); ?>
  </div>
<?php
}
?>
<form action="/usuario/cadastrar" method="post">
  <div class="container">
    <div id="login-row" class="row justify-content-center align-items-center">
      <div id="login-column" class="col-md-6">
        <div id="login-box" class="col-md-12">
          <form id="login-form" class="form" action="" method="post">
            <h3 class="text-center text-info">Cadastro</h3>
            <div class="form-group">
              <label for="nome" class="text-info">Nome:</label><br>
              <input type="text" name="nome" id="nome" class="form-control">
            </div>
            <div class="form-group">
              <label for="username" class="text-info">Username:</label><br>
              <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="password" class="text-info">Senha</label><br>
              <input type="password" name="senha" id="password" class="form-control">
            </div>
            <div id="register-link" class="text-right">
              <a href="<?php echo base_url() ?>/" class="text-info">Fazer login</a>
            </div>
            <div class="form-group">

              <input type="submit" name="submit" class="btn btn-info btn-md" value="Cadastro">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</form>