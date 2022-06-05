<?php

namespace App\Models;

use CodeIgniter\Model;

class TransacaoModel extends Model
{

    protected $table = 'transacao';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tipo', 'valor', 'conta', 'metodopagamento', 'datatransacao', 'descricao'];

    public function getDados($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        }
        return $this->asArray()->where(['id' => $id])->first();
    }

    public function insereTransacao($data)
    {
        return $this->insert($data);
    }

    public function alteraTransacao($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deletaTransacao($id = null)
    {
        if ($id != null) {
            $this->delete($id);
        }
    }

    
    public function getSaldo($idUsuario = null){
        $this->select('sum(transacao.valor) as total');
        $this->join('conta','conta.id = transacao.conta', 'left');

        return $this->asArray()->where(['conta.idusuario' => $idUsuario])->first();
    }
}
