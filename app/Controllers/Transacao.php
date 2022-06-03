<?php

namespace App\Controllers;

class Transacao extends BaseController
{
    public function mostraPagamento()
    {
        return view('transacao/pagamento');
    }
}
