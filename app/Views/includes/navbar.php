<!-- Top container -->


<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="w3-container w3-row">
        <div class="w3-col s4">
            <i class="fa fa-user fa-fw w3-xxxlarge"></i>
        </div>
        <div class="w3-col s8 w3-bar">
            <span>Bem vindo(a), <strong><?php echo $_SESSION['nome'] ?></strong></span><br>
            <button href="#" onclick="abrirMeuPerfil()" class="open-button w3-bar-item w3-button" id="abrirPopup">Visualizar
                perfil</button>
            <button href="#" onclick="fecharMeuPerfil()" class="open-button w3-bar-item w3-button" id="fecharPopup" style="visibility: hidden; position: absolute;">Fechar perfil</button>
            <a href="/usuario/logout" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i>Sair</a>
        </div>
    </div>
    <div class="form-popup" id="meuPerfil" style="display: none; border-left: 12px solid #029913;">
        <b style=" margin-left: 20px;">Nome:</b><br>
        <p style=" margin-left: 20px;"><?php echo $_SESSION['nome'] ?></p>
        <b style=" margin-left: 20px;">Username:</b>
        <p style=" margin-left: 20px;"><?php echo $_SESSION['username'] ?></p>
        <b style=" margin-left: 20px;">Conta Corrente:</b>
        <p style=" margin-left: 20px;"><?php echo $_SESSION['numeroCorrente'] ?></p>
        <b style=" margin-left: 20px;">Conta Poupança:</b>
        <p style=" margin-left: 20px;"><?php echo $_SESSION['numeroPoupanca'] ?></p>
    </div>
    <hr>
    <div class="w3-bar-block">
        <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Fechar Menu</a>
        <a href="/dashboard" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Dashboard</a>
        <a href="/conta/extrato/<?php echo $_SESSION['idUsuario'] ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-file-text-o fa-fw"></i>  Extrato da Conta Corrente</a>
        <div class="w3-col s8 w3-bar">
            <button href="#" onclick="abrirPoupanca()" class="open-button w3-bar-item w3-button" id="abrirPonpup"><i class="fa fa-bank fa-fw"></i>  Poupança</button>
        </div>
        <div class="form-popup" id="minhaPoupanca" style="display: none;">
            <b class="w3-button w3-padding" style=" margin-left: 20px;"><i class="fa fa-bank fa-fw"></i><?php echo 'R$' . $saldoPoupança ?> </b><br>
            <b style=" margin-left: 20px;"><a href="/transacao/mostraAplicacao/<?php echo $_SESSION['idUsuario'] ?>" class="w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  Aplicação</a></b><br>
            <b style=" margin-left: 20px;"><a href="/transacao/resgate/<?php echo $_SESSION['idUsuario'] ?>" class="w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  Resgate</a></a></b>
            <b style=" margin-left: 20px;"><a href="/conta/extratoPoupanca/<?php echo $_SESSION['idUsuario'] ?>" class="w3-bar-item w3-button w3-padding"> <i class="fa fa-file-text-o fa-fw"></i>  Extrato da Poupança</a></b>
        </div>
        <a href="/transacao/pagamento" class="w3-bar-item w3-button w3-padding"><i class="fa fa-money fa-fw"></i>  Pagamento</a>
        <a href="/transacao/transferencia" class="w3-bar-item w3-button w3-padding"><i class="fa fa-exchange fa-fw"></i>  Transferência</a>
    </div>
</nav>


<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<script>
    function abrirMeuPerfil() {
        document.getElementById("meuPerfil").style.display = "block";
        document.getElementById("abrirPopup").style.visibility = "hidden";
        document.getElementById("abrirPopup").style.position = "relative";
        document.getElementById("fecharPopup").style.visibility = "visible";
        document.getElementById("fecharPopup").style.position = "absolute";
    }

    function fecharMeuPerfil() {
        document.getElementById("meuPerfil").style.display = "none";
        document.getElementById("fecharPopup").style.visibility = "hidden";
        document.getElementById("fecharPopup").style.position = "relative";
        document.getElementById("abrirPopup").style.visibility = "visible";
        document.getElementById("abrirPopup").style.position = "absolute";
    }

    function abrirPoupanca() {
        let div = document.getElementById('minhaPoupanca');
        if (div.style.display !== 'none') {
            div.style.display = 'none';
        } else {
            div.style.display = 'block';
        }
    }
</script>