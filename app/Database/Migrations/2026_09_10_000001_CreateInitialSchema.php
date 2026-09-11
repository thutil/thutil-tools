<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInitialSchema extends Migration
{
    public function up()
    {
        // Enable PostGIS extension if running on PostgreSQL
        if ($this->db->DBDriver === 'Postgre') {
            $this->db->query('CREATE EXTENSION IF NOT EXISTS postgis;');
        }

        // Table for GIS bookmarks or saved geometry
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'geom_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'Point',
            ],
            'geojson' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('gis_records', true);
    }

    public function down()
    {
        $this->forge->dropTable('gis_records', true);
    }
}
