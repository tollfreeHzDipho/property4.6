<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePropertSessionLogTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=> 'INT',
                'unsigned' =>true,
                'auto_increment'=>true,
            ],
            'time'=>[
                'type'=>'INT',
                'comment'=>'stores login time'
            ],
             'user_id'=>[
                'type'=>'TEXT',
            ],
            'last_seen'=>[
                'type'=>'INT',
                'comment'=>'stores the last seen time'
            ],
            'status'=>[
                'type'=>'INT'
            ],             
            'date_created timestamp default current_timestamp',
            'date_modified timestamp default current_timestamp',            
        ]);
            $this->forge->addKey('id');
            //$this->forge->addForeignKey('user_id','users','id');
            $this->forge->createTable('session_log');
        }
    
        public function down()
        {
            $this->forge->dropTable('session_log');
        }
}
