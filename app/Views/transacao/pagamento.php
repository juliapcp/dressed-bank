<!DOCTYPE html>
<html lang="pt-BR">

<?php echo view('includes/head') ?>

<?php echo view('includes/navbar') ?>
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

    <div class="w3-container">
        <h3 id="titulo">Novo pagamento</h3>
        <form action="/transacao/pagamento" method="post">
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td><label for="data">Data: </label></td>
                        <td><label for="valor">Valor (R$): </label></td>
                        <td><label for="valor">Método de Pagamento: </label></td>
                    </tr>
                    <tr>
                        <td>
                            <input required type="date" class="w3-white w3-border w3-round-large" name="datatransacao">
                        </td>
                        <td>
                            <input required type="number" step=0.01 class="w3-white w3-border w3-round-large" name="valor">
                        </td>
                        <td>
                            <select class="w3-white w3-border w3-round-large" name="metodopagamento">
                                <option value="pix">Pix</option>
                                <option value="boleto">Boleto</option>
                                <option value="dinheiro">Dinheiro</option>
                                <option value="débito">Débito</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label for="descricao">Descrição: </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea style="width: 100%;" class=" w3-white w3-border w3-round-large" name="descricao"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <?php
                            if (session()->get('mensagem')) {
                            ?>
                                <div class="alert alert-info" role="alert">

                                    <?php echo "<strong>" . session()->getFlashdata('mensagem') . "</strong>"; ?>
                                </div>
                            <?php
                            }
                            ?>
                            <button style=" margin-left: 74%;" type="submit" class="w3-button w3-green">Cadastrar</button>
                            <input type="button" value="Cancelar" onclick="location.href = '/'" class="w3-button w3-red">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <hr>

    <?php echo view('includes/footer') ?>


</div>
</body>

</html>