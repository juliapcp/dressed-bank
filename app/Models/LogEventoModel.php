<?php

namespace App\Models;

use CodeIgniter\Model;

class LogEventoModel extends Model
{

    protected $table = 'logEvento';
    protected $primaryKey = 'id';
    protected $allowedFields = ['dataEvento', 'tipoEvento', 'idusuario'];

    public function insereLogEvento($data)
    {
        return $this->insert($data);
    }
}
