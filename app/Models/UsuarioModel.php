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

    public function getDateTime()
    {
        date_default_timezone_set('America/Sao_Paulo');
        return date('d-m-Y H:i:s');
    }

    public function insereUsuario($data)
    {
        $idUsuario = $this->insert($data);
        $dataContaPoupanca = array(
            'tipo' => 'P',
            'idusuario' => $idUsuario,
            'numero' => mt_rand(1000000000,9999999999)
        );
        $dataContaCorrente = array(
            'tipo' => 'C',
            'idusuario' => $idUsuario,
            'numero' => mt_rand(1000000000,9999999999)
        );
        $modelConta = new ContaModel();
        $modelConta->insereConta($dataContaPoupanca);
        $modelConta->insereConta($dataContaCorrente);
        return $idUsuario;
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
    public function DifMesesUltimoLogin($idUsuario){
        $db      = \Config\Database::connect();
        $builder = $db->table('conta');
        $builder->select("coalesce(DATE_PART('month', AGE((select MAX (DATAEVENTO) from logevento where idusuario=".$idUsuario." and tipoevento='LOGIN'), now())),0) AS mesesultimologin");
        return $builder->get()->getResult('array')[0];
    }
}
