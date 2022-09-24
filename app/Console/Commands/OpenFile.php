<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OpenFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:open';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'open file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = "database/csv/food.csv";
        $file = fopen($filename, "r");
        if($file){
            $this->line("success");
            $array = explode(",", trim(fgets($file),"\n"));
            $this->line($array[0]);
            $this->line($array[1]);
            $this->line($array[2]);

        }else{
            $this->line("fail");
        }
        fclose($file);
        return 0;
    }
}
