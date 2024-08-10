<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHistoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=> 'INT',
                'unsigned' =>true,
                'auto_increment'=>true,
            ],
             'action'=>[
                'type'=> 'TEXT',
             ],
             'user_id'=>[
               'type'=> 'INT',
                'unsigned' =>true,
             ],
             'date_created timestamp default current_timestamp' 
            ]);
      $this->forge->addKey('id',true);      
      $this->forge->addForeignKey('user_id','users','id');
      $this->forge->createTable('history',true);
      }
    public function down()
    {$this->forge->dropTable('history');
    }
}
