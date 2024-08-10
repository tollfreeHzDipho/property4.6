<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePropertyTable extends Migration
{
       public function up()
        {  
             $this->forge->addField([
            'id'=>[
                'type'=> 'INT',
                'unsigned' =>true,
                'auto_increment'=>true,
            ],
            'serial_no'=>[
                'type'=>'VARCHAR',
                'constraint'=>'400',
            ],
            'tenure'=>[
               'type'=>'VARCHAR',
                'constraint'=>'100',  
                'null'=>true              
            ],
            'property_address'=>[
                'type'=>'TEXT',            
            ],
            'bank_id'=>[
                'type'=>'INT',
                'unsigned' =>true,            
            ],
             'bank_option'=>[
                'type'=>'TEXT',
                'null'=>true           
            ],
            'north'=>[
                'type'=>'VARCHAR',
                'constraint'=>'100',  
                'null'=>true         
            ],
            'east'=>[
                'type'=>'VARCHAR',
                'constraint'=>'100', 
                'null'=>true          
            ],
            'zone'=>[
                'type'=>'VARCHAR',
                'constraint'=>'25', 
                'null'=>true         
            ],
            'c_north'=>[
                'type'=>'VARCHAR',
                'constraint'=>'100', 
                'null'=>true            
            ],
            'c_east'=>[
                'type'=>'VARCHAR',
                'constraint'=>'100', 
                'null'=>true             
            ],
            'date_of_val'=>[
                'type'=>'DATE',         
            ],
             'acreage'=>[
                'type'=>'VARCHAR',  
                'constraint'=>'100'       
            ], 
             'rate_per_acre'=>[
                'type'=>'DOUBLE',  
                'constraint'=>'100,2',
                'null'=>false,
                'default'=>0.00       
            ],
            'property_value'=>[
                'type'=>'DOUBLE',  
                'constraint'=>'100,2',
                'null'=>false,
                'default'=>0.00       
            ],
             'user_status'=>[
                'type'=>'VARCHAR',  
                'constraint'=>'50',                 
            ],
             'user_option'=>[
                'type'=>'VARCHAR',  
                'constraint'=>'100', 
                'null'=>true                
            ],
             'notes'=>[
                'type'=>'TEXT',                   
            ],
            'valuer_id'=>[
                'type'=>'INT',  
                'constraint'=>'11',                 
            ],
            'firm_id'=>[
                'type'=>'INT',                
            ],
            'district_id'=>[
                'type'=>'INT',                
            ],
            'town_id'=>[
                'type'=>'INT',                
            ],
            'village_id'=>[
                'type'=>'INT',                
            ],
            'village_id'=>[
                'type'=>'INT',                
            ],
            'status_id'=>[
                'type'=>'INT',                
            ],
            'comment'=>[
                'type'=>'TEXT',
                'null'                
            ],
            'category_id'=>[
                'type'=>'INT',                
            ],
            'created_by'=>[
                'type'=>'INT',                
            ],
            'date_created timestamp default current_timestamp',
            'date_modified timestamp default current_timestamp',
            'modified_by'=>[
                'type'=>'INT',
            ]]);
    
            $this->forge->addKey('id');
            $this->forge->addForeignKey('valuer_id','users','id');
            $this->forge->addForeignKey('firm_id','firms','id');
            $this->forge->addForeignKey('village_id','villages','id');
            $this->forge->addForeignKey('district_id','district','id');
            $this->forge->addForeignKey('town_id','towns','id');
            $this->forge->addForeignKey('created_by','users','id');
            $this->forge->addForeignKey('modified_by','users','id'); 
    
            $this->forge->createTable('property',true);
        }
    
        public function down()
        {
            $this->forge->dropTable('property');
        }
    }
    