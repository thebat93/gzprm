<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;

class kodresponse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kodresponse {--content=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ответ от КОД';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $content = $this->option('content');
        $arr = explode("\n", $content);
        $order = Order::where('id', $arr[0])->first();
        $order->state = $arr[1];
        $order->save();
        if (isset($arr[2])) {
                if (Storage::exists("KOD/in/$arr[2]")) {
                        Storage::move("KOD/in/$arr[2]", "Archive/$arr[2]"");
                        }
        }

    }
}
