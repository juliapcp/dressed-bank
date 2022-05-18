<!DOCTYPE html>
<html lang="pt-BR">
<?php echo view('includes/head') ?>
<?php echo view('includes/navbar') ?>
<?php echo view('includes/footer') ?>


<div class="w3-main" style="margin-left:300px;margin-top:43px;">
        <header class="w3-container" style="padding-top:22px">
            <h4 id="titulo">Dashboard</h4>
        </header>
    
        <div class="w3-row-padding w3-margin-bottom">
            <div class="w3-third">
                <div class="w3-container w3-teal w3-padding-16">
                    <div class="w3-left"><i class="fa fa-line-chart w3-xxxlarge"></i></div>
                    <div class="w3-right">
                        <h3>--</h3>
</div>
<div class="w3-clear"></div>
<h4>Receita</h4>
</div>
</div>
<div class="w3-third">
    <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-level-down w3-xxxlarge"></i></div>
        <div class="w3-right">
            <h3>--</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Despesa</h4>
    </div>
</div>
<div class="w3-third">
    <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
            <h3>--</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Saldo</h4>
    </div>
</div>


</div>


<div class="w3-container">
    <h4 id="titulo">Transações</h4>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
        
        <p>Ops, você ainda não registrou nenhuma transação, <a class="w3-text-green" onclick="location.href='/transacao/cadastro'">registre</a> para começar a controlar suas finanças</p>
        
</div>
<hr>


</div>
<script>
    let campo = document.getElementById('campo');
    let valor = document.querySelector("#valor");
    campo.addEventListener("change", function() {
        console.log("entrou");
        if (campo.value == 'data') {
            valor.type = 'date'
        } else {
            valor.type = "text"
        }
    });
    valor.addEventListener("input", function() {
        valor.value = valor.value.toUpperCase();
    });
</script>
</body>

</html>