<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateVotingTables extends Migration
{
    public function up()
    {
        // Table: candidates
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'        => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'vision'      => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'mission'      => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'image'       => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at'  => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')

            ],
            'updated_at'  => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')

            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('candidates', true);

        // Table: users
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username'    => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'password'    => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'role'        => [
                'type'       => 'ENUM',
                'constraint' => ['Siswa', 'Admin'],
                'default'    => 'Siswa',
            ],
            'created_at'  => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')

            ],
            'updated_at'  => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')

            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users', true);

        // Table: votes
        $this->forge->addField([
            'id'           => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'candidate_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'timestamp'    => [
                'type' => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP')

            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['user_id', 'candidate_id' ]);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('candidate_id', 'candidates', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('votes', true);
    }

    public function down()
    {
        $this->forge->dropTable('votes', true);
        $this->forge->dropTable('users', true);
        $this->forge->dropTable('candidates', true);
    }
}
