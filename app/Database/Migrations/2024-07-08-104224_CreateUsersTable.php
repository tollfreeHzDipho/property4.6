<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=> 'INT',
                'unsigned' =>true,
                'auto_increment'=>true,
            ],
            'first_name'=>[
                'type'=>'VARCHAR',
                'constraint'=>'50'
            ],
            'last_name'=>[
                'type'=>'VARCHAR',
                 'constraint'=>'50'
            ],
             'email'=>[
                'type'=>'VARCHAR',
                'constraint'=>'200'
            ],
            'password'=>[
                'type'=>'VARCHAR',
                'constraint'=>'450'
            ],
            'pass_check'=>[
                'type'=>'INT',
                'constraint'=>'2'
            ], 
             'gender'=>[
                'type'=>'vARCHAR',
                'constraint'=>'20'
            ],            
              'status_id'=>[
                'type'=>'INT',
            ],          
              'role_id'=>[
                'type'=>'INT',
            ],
            'my_count'=>[
                'type'=>'INT',
                'constraint'=>'2'                
            ],           
            'other_names'=>[
                'type'=>'INT',
            ],
            'firm_id'=>[
                'type'=>'INT',
            ],
            'branch_id'=>[
                'type'=>'INT',
            ],
            'f_code'=>[
                'type'=>'VARCHAR',
                'constraint'=>'200'
            ],
            'f_email'=>[
                'type'=>'VARCHAR',
                'constraint'=>'200'
            ],
            
            'f_time timestamp default current_timestamp', 
            'comment'=>[
                'type'=>'TEXT',
            ],
            'salutation'=>[
                'type'=>'VARCHAR',
                'constraint'=>'20'
            ],
            'initials'=>[
                'type'=>'VARCHAR',
                'constraint'=>'10'
            ], 
            'photo'=>[
                'type'=>'TEXT',
            ], 
            'created_by'=>[
                'type'=>'INT',
            ],                                    
            'date_created timestamp default current_timestamp',
            'modified_by'=>[
                'type'=>'INT',
            ], 
            'date_modified timestamp default current_timestamp on update current_timestamp',            
        ]);
            $this->forge->addKey('id');
            /* $this->forge->addForeignKey('status_id','status','id');
            $this->forge->addForeignKey('firm_id','firm','id');
            $this->forge->addForeignKey('branch_id','branches','id'); */
            $this->forge->createTable('users');
        }
    
        public function down()
        {
            $this->forge->dropTable('users');
        }
}
