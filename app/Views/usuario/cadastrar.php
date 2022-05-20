<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php if (\Config\Services::validation()->getErrors()){
?>
<div class="alert alert-danger" role="alert">
<?= \Config\Services::validation()->listErrors();?>
</div>
<?php
}
?>

<form action="/usuario/cadastrar" method="post">
        <div class="form-group">
          <div class="col-md-4 mb-3">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-4 mb-3">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-4 mb-3">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name = "senha">
          </div>
        </div>
        
      
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
