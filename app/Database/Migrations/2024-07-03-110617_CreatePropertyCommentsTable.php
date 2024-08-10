<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePropertyCommentsTable extends Migration
{
    public function up()
    {  
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
         'reply'=>[
            'type'=>'VARCHAR',
            'constraint'=>'300',
        ],
        'review'=>[
            'type'=>'VARCHAR',
            'constraint'=>'50',                     
        ],
         
        'date_created timestamp default current_timestamp',
        'date_modified timestamp default current_timestamp',
        'created_by'=>[
            'type'=>'INT',           
        ],
        'property_id'=>[
            'type'=>'VARCHAR',
            'constraint'=>'5',            
        ]
    ]);
        $this->forge->addKey('id');
        //$this->forge->addForeignKey('created_by','users','id');
        //$this->forge->addForeignKey('property_id','property','id');
        $this->forge->createTable('property_comments',true);
    }

    public function down()
    {
        $this->forge->dropTable('property_comments');
    }
}
