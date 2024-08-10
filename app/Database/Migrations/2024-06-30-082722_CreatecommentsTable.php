<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatecommentsTable extends Migration
{
    public function up(){
    
        $this->forge->addField([
        'id'=>[
            'type'=> 'INT',
            'unsigned' =>true,
            'auto_increment'=>true,
        ],
        'comment'=>[
            'type'=>'VARCHAR',
            'constraint'=>'400',
        ],
         'unique_id'=>[
            'type'=>'VARCHAR',
            'constraint'=>'100',
        ],
        'roles'=>[
            'type'=>'VARCHAR',
            'constraint'=>'100',                     
        ],
         'reply_id'=>[
            'type'=>'VARCHAR',
            'constraint'=>'100',            
        ],
        'reply_status'=>[
            'type'=>'VARCHAR',
            'constraint'=>'5',            
        ],
        'send_date timestamp default current_timestamp'       
        ]);
        $this->forge->addKey('id',true);      
          $this->forge->createTable('comments',true);
}

    public function down()
    {
    $this->forge->dropTable('comments');
    }
}
