<?php

namespace App\Controllers;

class Transacao extends BaseController
{
    public function mostraCadastro()
    {
        return view('transacao/cadastro');
    }
}
