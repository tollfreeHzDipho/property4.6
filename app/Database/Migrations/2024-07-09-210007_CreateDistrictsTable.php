<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDistrictsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=> 'INT',
                'unsigned' =>true,
                'auto_increment'=>true,
            ],
            'district_name'=>[
                'type'=>'VARCHAR',
                'constraint'=>'200',
            ],
             'country_id'=>[
                'type'=>'INT',
            ],
             'status_id'=>[
                'type'=>'INT'
            ],
            'created_by'=>[
                'type'=>'INT',
            ], 
             'modified_by'=>[
                'type'=>'INT',
            ],            
            'date_created timestamp default current_timestamp',
            'date_modified timestamp default current_timestamp on update current_timestamp',            
        ]);
            $this->forge->addKey('id');
            $this->forge->createTable('district');
        }
    
        public function down()
        {
            $this->forge->dropTable('district');
        }
}
