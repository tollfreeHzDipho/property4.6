<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use DateTime;

class CreateBanksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
        'id'=>[
            'type'=> 'INT',
            'unsigned' =>true,
            'auto_increment'=>true,
        ],
        'bank_name'=>[
            'type'=>'VARCHAR',
            'constraint'=>'400',
        ],
        'status_id'=>[
            'type'=>'INT',
            'unsigned' =>true,            
        ],
        'date_created timestamp default current_timestamp',
        'date_modified timestamp default current_timestamp',
        'modified_by'=>[
            'type'=>'INT',
            'unsigned'=>true,
            'constraint'=>'11'
        ]
        ]);
        $this->forge->addKey('id',true);
        $this->forge->addForeignKey('status_id','status','id');
        $this->forge->createTable('banks',true);
    }

    public function down()
    {
        $this-> forge->dropTable('banks');
    }
}
