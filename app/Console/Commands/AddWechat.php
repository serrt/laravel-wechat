<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Wechat;

class AddWechat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wechat:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add wechat app';

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
     * @return int
     */
    public function handle()
    {
        $type = $this->choice('公众号 or 小程序?', Wechat::$typeMap, 0);
        $type = data_get(array_flip(Wechat::$typeMap), $type);

        $name = $this->ask('Name');

        $app_id = $this->ask('AppId');

        $app_secret = $this->ask('AppSecret');

        $app = Wechat::create(compact("type", "name", "app_id", "app_secret"));

        $this->info('Wechat ID ' . $app->id);

        return 0;
    }
}
