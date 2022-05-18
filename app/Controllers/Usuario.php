<?php

namespace App\Controllers;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    public function mostraCadastroUsuario()
    {
        return view('/usuario/cadastrar');
    }

    public function loginUsuario()
    {
        return view('/usuario/login');
    }



    public function insertusuario(){
		$rules = [
			'nome' => 'required|min_length[3]|max_length[50]',
			'username' => 'required|min_length[6]|max_length[50]',
			'senha'=> 'required|min_length[1]|max_length[60]', 
		];
		$customers_model = new UsuarioModel();
		if ($this->validate($rules)){
			$data = array(
				'nome' => $this->request->getVar('nome'),
				
				'username' => $this->request->getVar('username'),

				'senha' =>$this->request->getVar('senha')

			);	
		$customers_model->insereUsuario($data);
		return redirect()->to(base_url('/'));
		}
		else{
			$this->mostraCadastroUsuario();		
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
}
