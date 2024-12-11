<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model {
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'email', 'telefone', 'segmento', 'created_at', 'updated_at'];
}
