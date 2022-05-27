<?php

namespace App\Controllers;
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



    public function insertUsuario(){


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
				'senha' => $this->request->getVar('senha')
			);
			$usuario->insereUsuario($data);
			return redirect()->to(base_url('/'));
		}
	}

    public function deletaUsuario($username=null){
		if ($username==null){
			return redirect()->to('home');
		}
		$username = new UsuarioModel();
		$result = $username->getDados($username);
		if ($result !=NULL){
			$username->deletaUsuario($result['username']);		
			return redirect()->to(base_url('home'));	
		}else{
			return redirect()->to(base_url('home'));
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
						$this->session->setFlashdata('Falha no login','Username ou senha incorretos.' );
						return redirect()->to(base_url('/'));
					}
					else{
						$data['logged_in'] = TRUE;
						$data['username'] = $userRow['username'];
						$data['nome'] = $userRow['nome'];
						$this->session->set($data);
							return redirect()->to(base_url('/dashboard'));
						}
	
	} 


}
}
