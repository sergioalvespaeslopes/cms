<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateCoordinatesInClientes extends Migration
{
    public function up()
    {
        // Alterando as colunas latitude e longitude para aumentar a precisão
        $this->forge->modifyColumn('clientes', [
            'latitude' => [
                'type' => 'DECIMAL',
                'constraint' => '18,15', // Ajustando a precisão
                'null' => true,
            ],
            'longitude' => [
                'type' => 'DECIMAL',
                'constraint' => '18,15', // Ajustando a precisão
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        // Se necessário, voltar para a configuração anterior
        $this->forge->modifyColumn('clientes', [
            'latitude' => [
                'type' => 'DECIMAL',
                'constraint' => '15,10', // Precisão original
                'null' => true,
            ],
            'longitude' => [
                'type' => 'DECIMAL',
                'constraint' => '15,10', // Precisão original
                'null' => true,
            ],
        ]);
    }
}
