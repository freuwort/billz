<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class RemoveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:remove {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove a user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        User::destroy($this->argument('id'));

        $this->info('User removed');
    }
}
