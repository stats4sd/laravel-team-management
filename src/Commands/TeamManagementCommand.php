<?php

namespace Stats4sd\TeamManagement\Commands;

use Illuminate\Console\Command;

class TeamManagementCommand extends Command
{
    public $signature = 'laravel-team-management';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
