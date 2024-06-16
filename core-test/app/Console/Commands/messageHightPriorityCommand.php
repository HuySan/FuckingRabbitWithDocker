<?php

namespace App\Console\Commands;

use App\Jobs\MakeHightPriorityMessageJob;
use Illuminate\Console\Command;

class messageHightPriorityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:message-hight-priority-command {message}';

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
        MakeHightPriorityMessageJob::dispatch($this->argument('message'))->onQueue('high');
    }
}
