<?php

namespace App\Models;

use CodeIgniter\Model;

class ContaModel extends Model
{

    protected $table = 'conta';
    protected $primaryKey = 'numero';
    protected $allowedFields = ['tipo, username, numero'];

    public function getDados($numero = null)
    {
        if ($numero == null) {
            return $this->findAll();
        }
        return $this->asArray()->where(['numero' => $numero])->first();
    }

    public function insereConta($data)
    {
        return $this->insert($data);
    }

    public function alteraConta($numero, $data)
    {
        return $this->update($numero, $data);
    }

    public function deletaConta($numero = null)
    {
        if ($numero != null) {
            $this->delete($numero);
        }
    }
}
