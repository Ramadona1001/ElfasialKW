<?php

use Illuminate\Database\Seeder;

class PermisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'Title',
            'logo' => 'Logo',
            'description' => 'Descriptions',
            'subject' => 'Subject',
            'keywords' => 'Keywords',
        ]);
    }
}
