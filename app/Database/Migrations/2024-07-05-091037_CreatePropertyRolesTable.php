<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePropertyRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=> 'INT',
                'unsigned' =>true,
                'auto_increment'=>true,
            ],
            'role_name'=>[
                'type'=>'VARCHAR',
                'constraint'=>'200',
            ],
             'description'=>[
                'type'=>'TEXT',
            ],
            'status_id'=>[
                'type'=>'INT'
            ],
            'firm_id'=>[
                'type'=>'INT'
            ],             
            'date_created timestamp default current_timestamp',
            'date_modified timestamp default current_timestamp',
            'created_by'=>[
                'type'=>'INT',           
            ],
            'modified_by'=>[
                'type'=>'INT',           
            ]
        ]);
            $this->forge->addKey('id');
            //$this->forge->addForeignKey('created_by','users','id');
            //$this->forge->addForeignKey('firm_id','firm','id');
            $this->forge->createTable('roles',true);
        }
    
        public function down()
        {
            $this->forge->dropTable('roles');
        }
}
