<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table = 'usuario';
    protected $primaryKey = 'username';
    protected $allowedFields = ['username, nome, senha'];

    public function getDados($username = null)
    {
        if ($username == null) {
            return $this->findAll();
        }
        return $this->asArray()->where(['username' => $username])->first();
    }

    public function insereUsuario($data)
    {
        var_dump($data);
        return $this->insert($data);
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
}
