<!DOCTYPE html>
<html lang="pt-BR">
<?php echo view('includes/head') ?>
<?php echo view('includes/footer') ?>

<div class="w3-container">
    <header class="w3-container" style="padding-top:40px">
        <h4 id="titulo">Extrato da Conta Corrente</h4>
    </header>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
        <thead>
            <tr>
                <th></th>
                <th>Método de Pagamento</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <?php
        if ($extratos != null) {
            foreach ($extratos as $extrato) {
                echo
                "<tr>
                <td><i class=\"fa fa-" . ($extrato['tipoTransacao'] == 'C' ? "plus w3-text-green" : "minus w3-text-red") . "\"></i></td>
                <td>" . $extrato['metodopagamento'] . "</td>
                <td>" . 'R$' . $extrato['valor'] . "</td>
                <td>" . date("d/m/Y", strtotime($extrato['datatransacao'])) . "</td>
                <td>" . $extrato['descricao'] . "</td>
            </tr>";
            }
        }
        ?>
        <tr>
            <td style="text-align:right;" colspan="5">Saldo da Conta: <b>R$: <?php echo $saldo ?>        </b></td>
        </tr>

    </table>
</div>