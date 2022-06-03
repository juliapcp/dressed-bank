<?php

namespace App\Models;

use CodeIgniter\Model;

class ContaModel extends Model
{

    protected $table = 'conta';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tipo', 'idusuario', 'numero'];

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

    //N SEI SE TA CERTO
    public function insereResgate($data)
    {
        return $this->insert($data);
    }

    public function insereResgate2($data2)
    {
        return $this->insert($data2);
    }
    //

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

    public function getContaUsuario($idUsuario, $tipoConta){
        $db      = \Config\Database::connect();
        $builder = $db->table('conta');
        $builder->select('id as idconta');
        $builder->where(['idusuario' => $idUsuario], ['tipo' => $tipoConta]);
        $builder->limit(1);
        return $builder->get()->getResult('array');
    }
}
