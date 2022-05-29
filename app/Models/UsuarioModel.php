<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'nome', 'senha'];

    public function getDados($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        }
        return $this->asArray()->where(['id' => $id])->first();
    }

    public function insereUsuario($data)
    {
        return $this->insert($data);
    }

    public function alteraUsuario($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deletaUsuario($id = null)
    {
        if ($id != null) {
            $this->delete($id);
        }
    }
    public function checkUserPassword($data){
        $custo = '08';
		$salt = 'Cf1f11ePArKlBJomM0F6aJ';
        return $this->where(['username' => $data['username'], 'senha' =>crypt($data['senha'],'$2a$' . $custo . '$' . $salt . '$')])->first();
    }
}
