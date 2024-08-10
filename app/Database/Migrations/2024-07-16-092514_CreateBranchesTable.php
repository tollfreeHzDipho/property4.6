<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBranchesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=> 'INT',
                'unsigned' =>true,
                'auto_increment'=>true,
            ],
            'branch_name'=>[
                'type'=>'VARCHAR',
                'constraint'=>'400',
            ],
             'branch_address'=>[
                'type'=>'TEXT',
                'constraint'=>'400',
            ],
            'status_id'=>[
                'type'=>'INT',
                'unsigned' =>true,            
            ],
             'firm_id'=>[
                'type'=>'INT',
                'unsigned' =>true,            
            ],
            'date_created timestamp default current_timestamp',
            'date_modified timestamp default current_timestamp',
            'created_by'=>[
                'type'=>'INT',
                'unsigned'=>true
            ] ,'modified_by'=>[
                'type'=>'INT',
                'unsigned'=>true
            ]
            ]);
            $this->forge->addKey('id',true);
            // $this->forge->addForeignKey('status_id','status','id');
            // $this->forge->addForeignKey('firm_id','firms','id');
            $this->forge->createTable('branches',true);
    }

    public function down()
    {
        $this->forge->dropTable('branches');
    }
}
