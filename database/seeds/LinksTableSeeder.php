<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'link_name' => 'google',
                'link_title' => 'google首頁',
                'link_url' => 'http://www.google.com',
                'link_order' => '1',
            ],
            [
                'link_name' => 'yahoo',
                'link_title' => 'yahoo首頁',
                'link_url' => 'http://www.yahoo.com.tw',
                'link_order' => '2',
            ]
        ];

        DB::table('links')->insert($data);
    }
}
