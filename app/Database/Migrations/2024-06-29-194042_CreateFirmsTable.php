<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFirmsTable extends Migration
{
    public function up()
    {
       $this->forge->addField([    
            'id'=>[
            'type'=> 'INT',
            'unsigned' =>true,
            'auto_increment'=>true,
        ],
        'firm_name'=>[
            'type'=>'VARCHAR',
            'constraint'=>'400',
        ],
         'firm_flag'=>[
            'type'=>'VARCHAR',
            'default'=>'yes',
            'constraint'=>'8',
        ],
        'counter'=>[
            'type'=>'INT',
            'unsigned' =>true,            
        ],
       ]);
        $this->forge->addKey('id',true);       
        $this->forge->createTable('firms',true);
}

public function down()
{
    $this->forge->dropTable('firms');
}
}
