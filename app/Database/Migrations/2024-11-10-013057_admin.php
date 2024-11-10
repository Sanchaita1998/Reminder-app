<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdminTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'membership_duration' => [
                'type'       => 'ENUM',
                'constraint' => ['3 months', '6 months', '1 year'],
                'null'       => false,
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'expiration_date' => [
                'type' => 'DATE',
                'null' => false,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('admin');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('admin');
    }
}
