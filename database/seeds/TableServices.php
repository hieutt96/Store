<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableServices extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
        	[        
            	'name' => 'CARD_GAME',
            	'description' => 'Mua Card Game',
            	'stat' => 1,
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
            	'name' => 'CARD_MOBILE',
            	'description' => 'Mua Card Mobile',
            	'stat' => 1,
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
            	'name' => 'TOPUP_MOBILE',
            	'description' => 'Nap tien Top Up',
            	'stat' => 1,
            	'created_at' => date('Y-m-d H:i:s'),
            	'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
