<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table = 'usuario';
    protected $primaryKey = 'username';
    protected $allowedFields = ['username', 'nome', 'senha'];

    public function getDados($username = null)
    {
        if ($username == null) {
            return $this->findAll();
        }
        return $this->asArray()->where(['username' => $username])->first();
    }

    public function insereUsuario($data)
    {
        $this->insert($data);
    }

    public function alteraUsuario($username, $data)
    {
        return $this->update($username, $data);
    }

    public function deletaUsuario($username = null)
    {
        if ($username != null) {
            $this->delete($username);
        }
    }
    public function checkUserPassword($data){
        return $this->where(['username' => $data['username'], 'senha' =>$data['senha']])->first();
    }
}
