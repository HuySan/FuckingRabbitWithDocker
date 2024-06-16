<?php

namespace App\Console\Commands;

use App\Jobs\MakeLowPriorityMessageJob;
use Illuminate\Console\Command;

class messageLowPriorityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:message-low-priority-command {message}';

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
        MakeLowPriorityMessageJob::dispatch($this->argument('message'))->onQueue('low');
    }
}
