<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactTypeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=> 'INT',
                'unsigned' =>true,
                'auto_increment'=>true,
            ],
             'contact_type'=>[
                'type'=> 'VARCHAR',
                'constraint' =>'12',
             ],
             'date_created timestamp default current_timestamp' 
            ]);
      $this->forge->addKey('id',true);      
      $this->forge->createTable('contact_type',true);
      }
    public function down()
    {$this->forge->dropTable('contact_type');
    }
}
