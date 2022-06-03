<?php

namespace App\Controllers;

use App\Models\TransacaoModel;

class Home extends BaseController
{
    public function index()
    {
        $transacao = new TransacaoModel();
        $data["transacoes"] = $transacao->getDados();
        return view('index', $data);
    }
}
