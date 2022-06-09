<!DOCTYPE html>
<html lang="pt-BR">
<?php echo view('includes/head') ?>
<?php echo view('includes/footer') ?>

<div class="w3-container">
        <h4 id="titulo">Transações</h4>
        <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
        <?php
            if ($extratos != null) {
            foreach ($extratos as $extrato) {
            echo 
            "<tr>
                <td></td>
                <td>" . $extrato['metodopagamento'] . "</td>
                <td>" .'R$'.$extrato['valor'] . "</td>
                <td>" . $extrato['datatransacao'] . "</td>
                <td>" . $extrato['descricao'] . "</td>
            </tr>";
            } 
        } 
        ?> 
    </table>
</div>
