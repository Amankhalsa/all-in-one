<?php

namespace Database\Seeders;
  
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $menu = new Menu();
        $menu->lable = 'Home';
        $menu->link = '/home';
        $menu->sort_id = '1';
        $menu->save();


    }
}
