<?php

use Illuminate\Database\Seeder;

class SocialMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('soical_media')->insert([
            'facebook' => 'facebook',
            'twitter' => 'twitter',
            'instagram' => 'instagram',
        ]);
    }
}
