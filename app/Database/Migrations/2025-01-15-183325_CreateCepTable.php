<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCepToClientes extends Migration
{
    public function up()
    {
        // Adiciona o campo 'cep' à tabela 'clientes'
        $this->forge->addColumn('clientes', [
            'cep' => [
                'type' => 'VARCHAR',
                'constraint' => '8',  // O CEP tem 8 caracteres no formato XXXXX-XXX
                'null' => true, // Permite valores nulos
            ],
        ]);
    }

    public function down()
    {
        // Remove a coluna 'cep' caso precise reverter a migration
        $this->forge->dropColumn('clientes', 'cep');
    }
}
