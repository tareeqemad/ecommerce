<?php

use Illuminate\Database\Seeder;
use App\Section;
class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionsRecords =
            [
                ['id'=>1,'name'=>'رجالي','status'=>1],
                ['id'=>2,'name'=>'حريمي','status'=>1],
                ['id'=>3,'name'=>'اطفال','status'=>1],

            ];
            Section::insert($sectionsRecords);
    }
}
