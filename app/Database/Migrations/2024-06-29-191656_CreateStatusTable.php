<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStatusTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=> 'INT',
                'unsigned' =>true,
                'auto_increment'=>true,
            ],
            'status_name'=>[
                'type'=>'VARCHAR',
                'constraint'=>'100',
            ],
            ]);
            $this->forge->addKey('id',true);          
            $this->forge->createTable('status',true);
    }

    public function down()
    {
        $this->forge->dropTable('status');
    }
}
