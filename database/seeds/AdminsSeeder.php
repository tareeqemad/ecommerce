<?php

use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $adminRecords = [
            ['id'=>1, 'name'=>'admin' , 'type'=>'admin'
                , 'mobile'=>'0592632026' , 'email'=>'admin@admin.com',
                'password'=>'$2y$10$OrykLNHw67Vtar03XMJYR.xKGmgLAEYOS0DnnrGYUwjRkaaR17mES' , 'image'=> '' , 'status' =>1
            ],
            ['id'=>2, 'name'=>'emad' , 'type'=>'subadmin'
                , 'mobile'=>'0592636059' , 'email'=>'subadmin@admin.com',
                'password'=>'$2y$10$z/EOPpmgQBvJoBu4Uejqg.x8tuDDw7ZyvtzrznmkkdrBxmLyTx7nW' , 'image'=> '' , 'status' =>1
            ],
            ['id'=>3, 'name'=>'tareq' , 'type'=>'typeadmin'
                , 'mobile'=>'0592689632' , 'email'=>'typeadmin@admin.com',
                'password'=>'$2y$10$z/EOPpmgQBvJoBu4Uejqg.x8tuDDw7ZyvtzrznmkkdrBxmLyTx7nW' , 'image'=> '' , 'status' =>1
            ],

        ];
        \Illuminate\Support\Facades\DB::table('admins')->insert($adminRecords);
      /*  foreach ($adminRecords as $key => $record) {
            \App\Admin::create($record);
        }*/
    }
}
