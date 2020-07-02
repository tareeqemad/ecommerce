<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(AdminsSeeder::class);
      $this->call(SectionsSeeder::class);
      $this->call(CategorySeeder::class);
    }
}
