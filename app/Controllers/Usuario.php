<?php

namespace App\Controllers;

use App\Models\ContaModel;
use App\Models\TransacaoModel;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    public function mostraCadastroUsuario()
    {
		$usuarioModel = new UsuarioModel();
		$data['usuarios'] = $usuarioModel-> getDados();
        return view('/usuario/cadastrar', $data);
    }

    public function loginUsuario()
    {
        return view('/usuario/login');
    }

	public function mostraDepositoInicial($idUsuario = null, $validation = null )
	{
		if ($idUsuario != null) {
			$data['validation'] = $validation;
			$data['idUsuario'] = $idUsuario;
			echo view('/usuario/depositoInicial', $data);
		} else {
			return redirect()->to(base_url('/'));
		}
	}

	public function depositoInicial($idUsuario = null)
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
					'descricao' => 'Depósito Inicial'
				);
				$transacaoModel->insereTransacao($data);
				return redirect()->to(base_url('/dashboard'));
			} else {
				$this->mostraDepositoInicial($idUsuario, $this->validator);
			}
		} else {
			return redirect()->to(base_url('/'));
		}
	}


    public function insertUsuario(){
		$custo = '08';
		$salt = 'Cf1f11ePArKlBJomM0F6aJ';

		$rules = [
			'nome' => 'required|max_length[100]',
			'username' => 'required',
			'senha' => 'required'
		];

				

		$usuario = new UsuarioModel();

		if ($this->validate($rules)) {
			$data = array(
				'nome' => $this->request->getVar('nome'),
				'username' => $this->request->getVar('username'),
				'senha' => crypt($this->request->getVar('senha'),'$2a$' . $custo . '$' . $salt . '$')
			);
			$idUsuario = $usuario->insereUsuario($data);
			return redirect()->to(base_url('/usuario/depositoInicial/'.$idUsuario));
		} else {
			$data['validation'] = $this->validator;
			$this->mostraCadastroUsuario();
		}
	}

    public function deletaUsuario($username=null){
		if ($username==null){
			return redirect()->to('/');
		}
		$username = new UsuarioModel();
		$result = $username->getDados($username);
		if ($result !=NULL){
			$username->deletaUsuario($result['username']);		
			return redirect()->to(base_url('/'));	
		}else{
			return redirect()->to(base_url('/'));
		}
	}


	public function loginUser(){
		
		$rules = [
			'username' => 'required',
			'senha'=> 'required', 
		];



		$usuario = new UsuarioModel();
		if ($this->validate($rules)){
			$data = array(
				'username' => $this->request->getVar('username'),

				'senha' => $this->request->getVar('senha'),

				'logged_in' => FALSE

			);
					if(!($userRow = $usuario->checkUserPassword($data))){
						$this->session->setFlashdata('loginFail','Username ou senha incorretos.' );
						return redirect()->to(base_url('/'));
					}
					else{
						$data['logged_in'] = TRUE;
						$data['username'] = $userRow['username'];
						$data['nome'] = $userRow['nome'];
						$this->session->set($data);
						return redirect()->to(base_url('/dashboard'));
						}
	
	} else {
			$data['validation'] = $this->validator;
			$this->loginUsuario();
		}


}
}
