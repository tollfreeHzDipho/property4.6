<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePositionsTable extends Migration
{
    public function up()
    {
      $this->forge->addField([
        'id'=>[
            'type'=> 'INT',
            'unsigned' =>true,
            'auto_increment'=>true,
        ],
         'position'=>[
            'type'=> 'TEXT',
        ],
        'description'=>[
            'type'=>'TEXT',
        ],
         'status_id'=>[
            'type'=>'INT',
        ],
        'firm_id'=>[
            'type'=>'INT',
        ],
        'date_created timestamp default current_timestamp',
        'date_modified timestamp default current_timestamp',
        'created_by'=>[
            'type'=>'INT',
            'unsigned'=>true
        ],
        'modified_by'=>[
            'type'=>'INT',
            'unsigned'=>true
        ] 
    ]);
        $this->forge->addKey('id',true);      
          $this->forge->createTable('positions',true);
}

    public function down()
    {
    $this->forge->dropTable('positions');
    }    
}
