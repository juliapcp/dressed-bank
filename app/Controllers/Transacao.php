<?php

namespace App\Controllers;

use App\Models\TransacaoModel;
use App\Models\ContaModel;


class Transacao extends BaseController
{
    
    public function mostraResgate($idUsuario = null, $validation = null )
	{
		if ($idUsuario != null) {
			$data['validation'] = $validation;
			$data['idUsuario'] = $idUsuario;
			echo view('/transacao/resgate', $data);
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
                $transacaoModel = new TransacaoModel();
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
					'tipo' => 'D',
					'valor' => $this->request->getVar('valor'),
					'conta' => ($contaModel->getContaUsuario($idUsuario, 'P')[0]['idconta']),
					'metodopagamento' => 'resgate',
					'datatransacao' => date("Y-m-d"),
					'descricao' => 'Valor do resgate' 
				);
				$transacaoModel->insereResgate($data);
				$transacaoModel->insereResgate2($data2);
				return redirect()->to(base_url('/dashboard'));
			} else {
				$this->mostraResgate($idUsuario, $this->validator);
			}
		} else {
			return redirect()->to(base_url('/'));
		}
	}
	
	public function extrato($idUsuario) {
		$extrato = new TransacaoModel();
        $data["extratos"] = $extrato->extrato($idUsuario);
		
		return view('/usuario/extrato', $data);
	}

    public function mostraPagamento()
    {
        return view('transacao/pagamento');
    }
    public function cadastraPagamento()
    {
        $rules = [
            'metodopagamento' => 'required',
            'valor' => 'required',
            'datatransacao' => 'required'
        ];

        $contaModel = new ContaModel();
        $conta = $contaModel->getContaUsuario($_SESSION['idUsuario'], "C")[0]["idconta"];
        $transacaoModel = new TransacaoModel();

        if ($this->validate($rules)) {
            $data = array(
                'metodopagamento' => $this->request->getVar('metodopagamento'),
                'valor' => $this->request->getVar('valor'),
                'descricao' => $this->request->getVar('descricao'),
                'tipo' => "D",
                'conta' => $conta,
                'datatransacao' => $this->request->getVar('datatransacao')
            );
            $transacaoModel->insereTransacao($data);
            return redirect()->to(base_url('/dashboard'));
        }    }
}
