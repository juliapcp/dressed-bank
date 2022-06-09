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
        $data["extratos"] = $extrato->extrato(($conta->getContaUsuario($_SESSION['idUsuario'], 'C'))[0]['idconta']);
		
		return view('/transacao/extrato', $data);
	}
	
	
}