<?php

namespace App\Controllers;

use App\Models\TransacaoModel;
use App\Models\ContaModel;


class Transacao extends BaseController
{
    
    public function mostraResgate($idUsuario = null, $validation = null )
	{
		if ($idUsuario != null) {
			$transacaoModel = new TransacaoModel();
			$data['validation'] = $validation;
			$data['idUsuario'] = $idUsuario;
			$data["saldo"] = $transacaoModel->getSaldo($_SESSION['idUsuario'], 'P');
			echo view('/transacao/resgate', $data);
		} else {
			return redirect()->to(base_url('/'));
		}
	}

	public function mostraAplicacao($idUsuario = null, $validation = null )
	{
		if ($idUsuario != null) {
			$transacaoModel = new TransacaoModel();
			$data['validation'] = $validation;
			$data['idUsuario'] = $idUsuario;
			$data["saldo"] = $transacaoModel->getSaldo($_SESSION['idUsuario'], 'C');
			echo view('/transacao/aplicacao', $data);
		} else {
			return redirect()->to(base_url('/'));
		}
	}

	public function aplicacao()
	{
			$rules = [
				
				'valor' => 'required'
			];
			if ($this->validate($rules)) {
                $transacaoModel = new TransacaoModel();
                $contaModel = new ContaModel();
				$data = array(
					'tipo' => 'D',
					'valor' => $this->request->getVar('valor'),
					'conta' => ($contaModel->getContaUsuario($_SESSION['idUsuario'], 'C')[0]['idconta']),
					'metodopagamento' => 'aplicação',
					'datatransacao' => date("Y-m-d"),
					'descricao' => 'Valor Aplicado' 
				);
                $data2 = array(
					'tipo' => 'C',
					'valor' => $this->request->getVar('valor'),
					'conta' => ($contaModel->getContaUsuario($_SESSION['idUsuario'], 'P')[0]['idconta']),
					'metodopagamento' => 'aplicação',
					'datatransacao' => date("Y-m-d"),
					'descricao' => 'Valor da aplicação' 
				);
				
				if (($transacaoModel->getSaldo($_SESSION['idUsuario'], 'C') < $this->request->getVar('valor'))||( $this->request->getVar('valor') <= 0)) {
					$this->session->setFlashdata('loginFail', 'SALDO MERDA.');
					return redirect()->to(base_url('transacao/aplicacao'));
				} else {
				$transacaoModel->insereTransacao($data);
				$transacaoModel->insereTransacao($data2);
				return redirect()->to(base_url('/dashboard'));
				}
			} else {
				$this->mostraResgate($_SESSION['idUsuario'], $this->validator);
			}
	}

	//n sei se ta certo 
	public function resgate()
	{
			$rules = [
				
				'valor' => 'required'
			];
			if ($this->validate($rules)) {
                $transacaoModel = new TransacaoModel();
                $contaModel = new ContaModel();
				$data = array(
					'tipo' => 'C',
					'valor' => $this->request->getVar('valor'),
					'conta' => ($contaModel->getContaUsuario($_SESSION['idUsuario'], 'C')[0]['idconta']),
					'metodopagamento' => 'resgate',
					'datatransacao' => date("Y-m-d"),
					'descricao' => 'Valor resgatado' 
				);
                $data2 = array(
					'tipo' => 'D',
					'valor' => $this->request->getVar('valor'),
					'conta' => ($contaModel->getContaUsuario($_SESSION['idUsuario'], 'P')[0]['idconta']),
					'metodopagamento' => 'resgate',
					'datatransacao' => date("Y-m-d"),
					'descricao' => 'Valor do resgate' 
				);
				
				if (($transacaoModel->getSaldo($_SESSION['idUsuario'], 'P') < $this->request->getVar('valor'))||( $this->request->getVar('valor') <= 0)) {
					$this->session->setFlashdata('loginFail', 'Saldo insuficiente para efetuar o resgate!!');
					return redirect()->to(base_url('/transacao/resgate'));
				} else {
				$transacaoModel->insereTransacao($data);
				$transacaoModel->insereTransacao($data2);
				return redirect()->to(base_url('/dashboard'));
				}
			} else {
				$this->mostraResgate($_SESSION['idUsuario'], $this->validator);
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
    public function mostraTransferencia()
    {
        return view('transacao/transferencia');
    }
    public function cadastraTransferencia()
    {
        $rules = [
            'valor' => 'required',
            'datatransacao' => 'required'
        ];

        $contaModel = new ContaModel();
		$conta = $contaModel->getContaUsuario($_SESSION['idUsuario'], "C")[0]["idconta"];
		$contaPoupanca = $contaModel->getContaUsuario($_SESSION['idUsuario'], "P")[0]["idconta"];
        $transacaoModel = new TransacaoModel();
		$contaDestino = $contaModel->getDados($this->request->getVar('contadestino'));
		if($contaDestino != null){
			if($contaDestino["id"] != $conta && $contaDestino["id"] != $contaPoupanca){
        if ($this->validate($rules)) {
			if($transacaoModel->getSaldo($_SESSION['idUsuario'], 'C') >= $this->request->getVar('valor') ){
            $data = array(
                'metodopagamento' => "transferencia",
                'valor' => $this->request->getVar('valor'),
                'descricao' => $this->request->getVar('descricao') . "| Conta de destino: ". $contaDestino["numero"],
                'tipo' => "D",
                'conta' => $conta,
                'datatransacao' => $this->request->getVar('datatransacao')
            );
            $transacaoModel->insereTransacao($data);
            $data2 = array(
                'metodopagamento' => "transferencia",
                'valor' => $this->request->getVar('valor'),
                'descricao' => $this->request->getVar('descricao') . "| Conta de origem: ". $contaModel->getContaUsuario($_SESSION['idUsuario'], "P")[0]["numero"],
                'tipo' => "C",
                'conta' => $contaDestino["id"],
                'datatransacao' => $this->request->getVar('datatransacao')
            );
			$transacaoModel = new TransacaoModel();
            $transacaoModel->insereTransacao($data2);
            return redirect()->to(base_url('/dashboard'));
		} else {
						$this->session->setFlashdata('mensagem', 'Você não possui saldo suficiente para fazer essa transferência.');
						return redirect()->to(base_url('/transacao/transferencia'));
		}
        }
		
	} else {
				$this->session->setFlashdata('mensagem', 'A conta destino não pode ser sua conta.');
				return redirect()->to(base_url('/transacao/transferencia'));
	}
		    } else {
				$this->session->setFlashdata('mensagem', 'A conta destino não existe, tente novamente.');
				return redirect()->to(base_url('/transacao/transferencia'));
			}
		    }
}
