<?php

namespace App\Controllers;

use App\Models\ContaModel;
use App\Models\TransacaoModel;
use App\Models\UsuarioModel;

class Conta extends BaseController
{
    public function mostraResgate($idUsuario = null, $validation = null )
	{
		if ($idUsuario != null) {
			$data['validation'] = $validation;
			$data['idUsuario'] = $idUsuario;
			echo view('/conta/resgate', $data);
		} else {
			return redirect()->to(base_url('/'));
		}
	}

public function resgate($idUsuario = null)
	{
		if ($idUsuario != null) {
			$rules = [
				'valor' => 'required'
			];
			if ($this->validate($rules)) {
				$contaModel = new ContaModel();
				$transacaoModel = new TransacaoModel();
				$data = array(
					'tipo' => 'C',
					'valor' => $this->request->getVar('valor'),
					'conta' => ($contaModel->getContaUsuario($idUsuario, 'C')[0]['idconta']),
					'metodopagamento' => 'dinheiro',
					'datatransacao' => date("Y-m-d"),
					'descricao' => 'Resgate do valor' 
				);
                $data2 = array(
					'tipo' => 'P',
					'valor' => '-'.$this->request->getVar('valor'),
					'conta' => ($contaModel->getContaUsuario($idUsuario, 'C')[0]['idconta']),
					'metodopagamento' => 'dinheiro',
					'datatransacao' => date("Y-m-d"),
					'descricao' => 'Resgate do valor' 
				);
				$transacaoModel->insereResgate($data);
				return redirect()->to(base_url('/dashboard'));
			} else {
				$this->mostraResgate($idUsuario, $this->validator);
			}
		} else {
			return redirect()->to(base_url('/'));
		}
	}
}