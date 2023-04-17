<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Menu;
class DemoCron extends Command
{
    protected $signature = 'demo:cron';
    protected $description = 'Command description';

    public function __construct(){
        parent::__construct();
        }
    
    // public function handle()
    // {
    //     return Command::SUCCESS;
    //     }

    public function handle(){

    \Log::info("Cron is working fine!");
        // Write your database logic we bellow:
           // Menu::create(['name'=>'blog']);
        }
}
