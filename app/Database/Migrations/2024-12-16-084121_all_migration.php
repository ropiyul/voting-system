<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AllMigration extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('grades', true);
  
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'        => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('programs', true);


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
            'grade_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'program_id'      => [
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
        $this->forge->addKey('grade_id');
        $this->forge->addKey('program_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('grade_id', 'grades', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('program_id', 'programs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('candidates', true);

        // Table: voters
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
            'grade_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'program_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nis'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 12,
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
        $this->forge->addKey('grade_id');
        $this->forge->addKey('program_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('grade_id', 'grades', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('program_id', 'programs', 'id', 'CASCADE', 'CASCADE');
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

            // periods
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
                ],
                'status' => [
                    'type'       => 'ENUM',
                    'constraint' => ['pending', 'ongoing', 'completed'],
                    'default'    => 'pending',
                ],
                'start_date' => [
                    'type' => 'DATETIME',
                    'null' => false,
                ],
                'end_date' => [
                    'type' => 'DATETIME',
                    'null' => false,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                    'default' => new RawSql('CURRENT_TIMESTAMP'),
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                    'default' => new RawSql('CURRENT_TIMESTAMP'),
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('periods', true);
    }

    public function down()
    {
        $this->forge->dropTable('grades', true);
        $this->forge->dropTable('programs', true);
        $this->forge->dropTable('admins', true);
        $this->forge->dropTable('votes', true);
        $this->forge->dropTable('voters', true);
        $this->forge->dropTable('candidates', true);
        $this->forge->dropTable('periods', true);
    }
}