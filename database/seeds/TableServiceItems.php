<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TableServiceItems extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_items')->insert([
        	[        
            	'services_id' => '1',
            	'code' => 'VCOIN',
            	'name' => 'VCOIN',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,300000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '1',
            	'code' => 'GATE',
            	'name' => 'GATE',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '1',
            	'code' => 'GARENA',
            	'name' => 'GARENA',
            	'discount' => 1,
            	'amount' => '20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '1',
            	'code' => 'ZING',
            	'name' => 'ZING',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,60000,100000,120000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '2',
            	'code' => 'VIETTEL',
            	'name' => 'VIETTEL',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '2',
            	'code' => 'MOBIFONE',
            	'name' => 'MOBIFONE',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '2',
            	'code' => 'VINAPHONE',
            	'name' => 'VINAPHONE',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '2',
            	'code' => 'SFONE',
            	'name' => 'SFONE',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '2',
            	'code' => 'GMOBILE',
            	'name' => 'GMOBILE',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '2',
            	'code' => 'VIETNAMMOBILE',
            	'name' => 'VIETNAMMOBILE',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '3',
            	'code' => 'VIETTEL',
            	'name' => 'VIETTEL',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '3',
            	'code' => 'MOBIFONE',
            	'name' => 'MOBIFONE',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '3',
            	'code' => 'VINAPHONE',
            	'name' => 'VINAPHONE',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '3',
            	'code' => 'SFONE',
            	'name' => 'SFONE',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [        
            	'services_id' => '3',
            	'code' => 'GMOBILE',
            	'name' => 'GMOBILE',
            	'discount' => 1,
            	'amount' => '10000,20000,50000,100000,200000,500000',
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
