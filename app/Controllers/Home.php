<?php

namespace App\Controllers;

use App\Models\TransacaoModel;
use App\Models\ContaModel;

class Home extends BaseController
{
    public function index()
    {
        $transacao = new TransacaoModel();
        $conta = new ContaModel();
        $data["transacoes"] = $transacao->getDadosContaCorrente(($conta->getContaUsuario($_SESSION['idUsuario'], 'C'))[0]['idconta']);
        $data["saldoP"] = $transacao->getSaldoPositivo($_SESSION['idUsuario'], 'C');
        $data["saldoN"] = $transacao->getSaldoNegativo($_SESSION['idUsuario'], 'C');
        $data["saldoPoupança"] = $transacao->getSaldo($_SESSION['idUsuario'], 'P');
        return view('index', $data);
    }
}
