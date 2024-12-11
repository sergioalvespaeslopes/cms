<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Define a tabela do banco de dados
    protected $primaryKey = 'id'; // Define a chave primária
    protected $allowedFields = ['email', 'password']; // Define os campos permitidos para inserção/atualização

    protected $useTimestamps = true; // Ativa o uso de timestamps
    protected $createdField  = 'created_at'; // Define o nome do campo para a data de criação
}

