<?php

use Illuminate\Database\Seeder;

class linksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= [
            [
                'link_name'=> '新浪网',
                'link_desc'=>'综合门户网站',
                'link_url' =>'http://www.sina.com.cn/',
                'link_order'=>1
            ],
            [
                'link_name'=> '网易',
                'link_desc'=>'有态度的综合门户网站',
                'link_url' =>'http://www.163.com/',
                'link_order'=>2
            ]


        ];
        DB::table('links')->insert($data);
    }
}
