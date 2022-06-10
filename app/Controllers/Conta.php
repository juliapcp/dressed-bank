<?php

namespace App\Controllers;

use App\Models\ContaModel;
use App\Models\TransacaoModel;
use App\Models\UsuarioModel;

class Conta extends BaseController
{
	
	public function extrato() {
		$extrato = new TransacaoModel();
		$conta = new ContaModel();
		$transacaoModel = new TransacaoModel();
        $data["extratos"] = $extrato->extrato(($conta->getContaUsuario($_SESSION['idUsuario'], 'C'))[0]['idconta']);
		$data["saldo"] = $transacaoModel->getSaldo($_SESSION['idUsuario'], 'C');
		
		return view('/transacao/extrato', $data);
	}

	public function extratoPoupanca() {
		$extrato = new TransacaoModel();
		$conta = new ContaModel();
		$transacaoModel = new TransacaoModel();
        $data["extratos"] = $extrato->extrato(($conta->getContaUsuario($_SESSION['idUsuario'], 'P'))[0]['idconta']);
		$data["saldo"] = $transacaoModel->getSaldo($_SESSION['idUsuario'], 'P');
		
		return view('/transacao/extratoPoupanca', $data);
	}
	
	
}