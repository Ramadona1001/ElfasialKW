<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'title' => 'Title',
            'logo' => 'Logo',
            'description' => 'Descriptions',
            'subject' => 'Subject',
            'keywords' => 'Keywords',
        ]);
    }
}
