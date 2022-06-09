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

    public function getDadosContaCorrente($idConta){

        $db      = \Config\Database::connect();
        $builder = $db->table('transacao');
        $builder->select('transacao.tipo as tipoTransacao, metodopagamento, valor, datatransacao, descricao');
        $builder->join('conta', 'conta.id = transacao.conta', 'left');
        $builder->where('conta.id', $idConta);
        return $builder->get()->getResult('array');
    }

    public function extrato($idConta) {
        $db      = \Config\Database::connect();
        $builder = $db->table('transacao');
        $builder->select('*');
        $builder->join('conta', 'conta.id = transacao.conta', 'left');
        $builder->where('conta.id', $idConta);
        return $builder->get()->getResult('array');
    }

    public function insereTransacao($data)
    {
        return $this->insert($data);
    }

    public function insereResgate($data)
    {
        return $this->insert($data);
    }

    public function insereResgate2($data2)
    {
        return $this->insert($data2);
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

    
    public function getSaldoPositivo($idUsuario = null, $tipoConta = null){
        $this->select('coalesce(sum(transacao.valor),0) as total');
        $this->join('conta','conta.id = transacao.conta', 'left');
        $this->where('transacao.tipo','C');
        $this->where('conta.tipo', $tipoConta);

        return $this->asArray()->where(['idusuario' => $idUsuario])->first();
    }

    public function getSaldoNegativo($idUsuario = null, $tipoConta = null){
        $this->select('coalesce(sum(transacao.valor),0) as total');
        $this->join('conta','conta.id = transacao.conta', 'left');
        $this->where('transacao.tipo','D');
        $this->where('conta.tipo', $tipoConta);

        return $this->asArray()->where(['idusuario' => $idUsuario])->first();
    }

    public function getSaldo($idUsuario = null, $tipoConta = null){
        return $this->getSaldoPositivo($idUsuario, $tipoConta)['total'] - $this->getSaldoNegativo($idUsuario, $tipoConta)['total'];
    }

}
