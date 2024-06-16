<?php

namespace App\Console\Commands;

use App\Jobs\MakeMessageJob;
use Illuminate\Console\Command;

class messageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message-command {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        MakeMessageJob::dispatch($this->argument('message'));
    }
}
