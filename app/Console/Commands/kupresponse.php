<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use Storage;

class kupresponse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kupresponse {--content=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ответ от КУП';

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
		if (Storage::exists("KUP/in/$arr[2]")) { 
			Storage::move("KUP/in/$arr[2]", "Archive/$arr[2]""); 
			}
	}
    }
}
