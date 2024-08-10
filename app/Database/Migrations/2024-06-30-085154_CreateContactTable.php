<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactTable extends Migration
{
    public function up()
    {
      $this->forge->addField([
        'id'=>[
            'type'=> 'INT',
            'unsigned' =>true,
            'auto_increment'=>true,
        ],
         'user_id'=>[
            'type'=> 'INT',
            'unsigned' =>true,
        ],
        'mobile_number'=>[
            'type'=>'VARCHAR',
            'constraint'=>'500',
            'null'=>true
        ],
         'contact_type_id'=>[
            'type'=>'INT',
            'constraint'=>'11',
            'null'=>true
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
          $this->forge->createTable('contact',true);
}

    public function down()
    {
    $this->forge->dropTable('contact');
    }
}
