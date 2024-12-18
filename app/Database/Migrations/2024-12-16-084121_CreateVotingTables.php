<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateVotingTables extends Migration
{
    public function up()
    {
        // Table: admin
        $this->forge->addField([
            'id'          => [
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
            'fullname'        => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
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
        $this->forge->addKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('admins', true);


        // Table: candidates
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nis'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 12,
            ],
            'user_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'fullname'        => [
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
        $this->forge->addKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('candidates', true);

        // Table: voters
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nis'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 12,
            ],
            'user_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'fullname'        => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
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
        $this->forge->addKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('voters', true);

        // Table: votes
        $this->forge->addField([
            'id'           => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'voter_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'candidate_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'voted_at'    => [
                'type' => 'DATETIME',
                'default' => new RawSql('CURRENT_TIMESTAMP')

            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['voter_id', 'candidate_id' ]);
        $this->forge->addForeignKey('voter_id', 'voters', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('candidate_id', 'candidates', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('votes', true);
    }

    public function down()
    {
        $this->forge->dropTable('admins', true);
        $this->forge->dropTable('votes', true);
        $this->forge->dropTable('voters', true);
        $this->forge->dropTable('candidates', true);
    }
}
