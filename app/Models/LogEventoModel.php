<?php

namespace App\Models;

use CodeIgniter\Model;

class LogEventoModel extends Model
{

    protected $table = 'logevento';
    protected $primaryKey = 'id';
    protected $allowedFields = ['dataevento', 'tipoevento', 'idusuario'];

    public function insereLogEvento($data)
    {   
        return $this->insert($data);
    }
}
