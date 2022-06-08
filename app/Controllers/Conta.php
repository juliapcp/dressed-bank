<?php

namespace App\Controllers;

use App\Models\ContaModel;
use App\Models\TransacaoModel;
use App\Models\UsuarioModel;

class Conta extends BaseController
{
<<<<<<< HEAD
=======
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
	//n sei se ta certo 
	public function resgate($idUsuario = null)
	{
		if ($idUsuario != null) {
			$rules = [
				
				'valor' => 'required'
			];
			if ($this->validate($rules)) {
				$contaModel = new ContaModel();
				$data = array(
					'tipo' => 'C',
					'valor' => $this->request->getVar('valor'),
					'conta' => ($contaModel->getContaUsuario($idUsuario, 'C')[0]['idconta']),
					'metodopagamento' => 'resgate',
					'datatransacao' => date("Y-m-d"),
					'descricao' => 'Valor resgatado' 
				);
                $data2 = array(
					'tipo' => 'P',
					'valor' => '-'.$this->request->getVar('valor'),
					'conta' => ($contaModel->getContaUsuario($idUsuario, 'P')[0]['idconta']),
					'metodopagamento' => 'resgate',
					'datatransacao' => date("Y-m-d"),
					'descricao' => 'Valor do resgate' 
				);
				$contaModel->insereResgate($data);
				$contaModel->insereResgate2($data2);
				var_dump($data2);
				return redirect()->to(base_url('/dashboard'));
			} else {
				$this->mostraResgate($idUsuario, $this->validator);
			}
		} else {
			return redirect()->to(base_url('/'));
		}
	}
	
	public function extrato() {
		$extrato = new TransacaoModel();
		$conta = new ContaModel();
        $data["extratos"] = $extrato->extrato(($conta->getContaUsuario($_SESSION['idUsuario'], 'C'))[0]['idconta']);
		
		return view('/conta/extrato', $data);
	}
>>>>>>> b9d0b30536c1e2b668565fb41d5b66654622277d
	
	
}