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
        $builder->select('transacao.tipo as tipoTransacao, metodopagamento, valor, datatransacao, descricao');
        $builder->join('conta', 'conta.id = transacao.conta', 'left');
        $builder->where('conta.id', $idConta);
        return $builder->get()->getResult('array');
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

    public function GeraJurosPoupanca($idUsuario = null){
        $usuario = new UsuarioModel();
        $transacaoModel = new TransacaoModel();
        $contaModel = new ContaModel();
        $investimento_inicial = $this->getSaldo($_SESSION['idUsuario'], 'P');
        $meses =  $usuario->DifMesesUltimoLogin($idUsuario);
        $taxa_de_juros = 6.20/12;
        $investimento_acumulado = $investimento_inicial;
        $investimento_acumulado2 = $investimento_inicial + $meses;
        $juros_compostos_total = 0;
for ($i = 0; $i < $meses; $i++) {
    $juros_compostos = ($investimento_acumulado * $taxa_de_juros) / 100;
    $juros_compostos_total += $juros_compostos;
    $investimento_acumulado += $juros_compostos;
}

$valor_a_receber = $investimento_acumulado2 + $juros_compostos_total;
			
$data = array(
    'tipo' => 'C',
    'valor' => $valor_a_receber,
    'conta' => ($contaModel->getContaUsuario($_SESSION['idUsuario'], 'P')[0]['idconta']),
    'metodopagamento' => 'rendimento',
    'datatransacao' => date("Y-m-d"),
    'descricao' => 'Rendimento da poupanca' 
);
$transacaoModel->insereTransacao($data);

    }

}
