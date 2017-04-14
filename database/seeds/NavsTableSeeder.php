<?php

use Illuminate\Database\Seeder;

class NavsTableSeeder extends Seeder
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
                'nav_name'=> '新闻',
                'nav_alias'=>'news',
                'nav_url' =>'http://www.sina.com.cn/',
                'nav_order'=>1
            ],
            [
                'nav_name'=> '娱乐',
                'nav_alias'=>'yeusandn',
                'nav_url' =>'http://www.si/',
                'nav_order'=>2
            ],
            [
                'nav_name'=> '军事',
                'nav_alias'=>'haisda',
                'nav_url' =>'http://www.si/',
                'nav_order'=>3
            ]
        ];
        DB::table('navs')->insert($data);
    }
}
