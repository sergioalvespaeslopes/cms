<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model {
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'email', 'telefone', 'segmento', 'created_at', 'updated_at', 'latitude', 'longitude', 'cep'];

    // Habilita o soft delete
    protected $useSoftDeletes = true; // Ativa o soft delete
    protected $deletedField  = 'deleted_at'; // Campo para armazenar a data de exclusão
    protected $dateFormat     = 'datetime'; // Formato de data
    protected $returnType     = 'array'; // Tipo de retorno
    protected $useTimestamps  = true; // Habilita o uso de timestamps (created_at, updated_at)
}
