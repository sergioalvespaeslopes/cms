<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeletedAtToClientes extends Migration
{
    public function up()
    {
        // Adicionar a coluna deleted_at na tabela clientes
        $this->forge->addColumn('clientes', [
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,  // Permitindo valores nulos
            ]
        ]);
    }

    public function down()
    {
        // Remover a coluna deleted_at
        $this->forge->dropColumn('clientes', 'deleted_at');
    }
}
