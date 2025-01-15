<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCoordinatesToClientes extends Migration
{
    public function up()
    {
        $this->forge->addColumn('clientes', [
            'latitude' => [
                'type' => 'DECIMAL',
                'constraint' => '10,8',
                'null' => true, // Permitir valores nulos inicialmente
            ],
            'longitude' => [
                'type' => 'DECIMAL',
                'constraint' => '11,8',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('clientes', 'latitude');
        $this->forge->dropColumn('clientes', 'longitude');
    }
}
