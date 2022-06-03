<?php

namespace App\Controllers;

use App\Models\TransacaoModel;
use App\Models\ContaModel;


class Transacao extends BaseController
{
    public function mostraPagamento()
    {
        return view('transacao/pagamento');
    }
    public function cadastraPagamento()
    {
        $rules = [
            'metodopagamento' => 'required',
            'valor' => 'required',
            'datatransacao' => 'required'
        ];

        $contaModel = new ContaModel();
        $conta = $contaModel->getContaUsuario($_SESSION['idUsuario'], "C")[0]["idconta"];
        $transacaoModel = new TransacaoModel();

        if ($this->validate($rules)) {
            $data = array(
                'metodopagamento' => $this->request->getVar('metodopagamento'),
                'valor' => $this->request->getVar('valor'),
                'descricao' => $this->request->getVar('descricao'),
                'tipo' => "D",
                'conta' => $conta,
                'datatransacao' => $this->request->getVar('datatransacao')
            );
            $transacaoModel->insereTransacao($data);
            return redirect()->to(base_url('/dashboard'));
        }    }
}
