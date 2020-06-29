<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            ['id'=>1,'parent_id'=>0,'section_id'=>1,'category_name'=>'T-shirts','category_image'=>'',
                'category_discount'=>1,'description'=>'','url'=>'t-shirts',
                'meta_title'=>'' , 'meta_description'=>'' , 'meta_keywords'=>'' ,
                'status'=>1
                ],
        ];
        Category::insert($categoryRecords);
    }
}
