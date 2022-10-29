<?php

namespace App\Console\Commands;

use App\Models\Food;
use Illuminate\Console\Command;
use PHPUnit\Util\Json;
use function MongoDB\BSON\toJSON;

class EchoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'echo:path';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $food = Food::find(1);
        $food->img_path = url('/storage/images/001.jpg');
        $food->save();
        $this->info($food);
    }
}
