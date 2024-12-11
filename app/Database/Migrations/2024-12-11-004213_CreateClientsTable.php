<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientsTable extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'nome' => [
            'type' => 'VARCHAR',
            'constraint' => '255',
        ],
        'email' => [
            'type' => 'VARCHAR',
            'constraint' => '255',
        ],
        'telefone' => [
            'type' => 'VARCHAR',
            'constraint' => '20',
        ],
        'segmento' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
        ],
        'created_at' => [
            'type' => 'DATETIME',
        ],
        'updated_at' => [
            'type' => 'DATETIME',
        ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('clientes');
}

public function down()
{
    $this->forge->dropTable('clientes');
}

}
