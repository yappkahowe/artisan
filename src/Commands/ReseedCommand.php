<?php

namespace YappKaHowe\Artisan\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Symfony\Component\Console\Input\InputOption;

class ReseedCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'db:reseed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate and seed the database with records';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! $this->confirmToProceed()) return;

        $parameters = [
            '--database' => $this->getDatabase(),
            '--force' => $this->option('force'),
        ];

        $this->call('db:truncate', $parameters);

        $this->call('db:seed', $parameters);
    }

    /**
     * Get the name of the database connection to use.
     *
     * @return string
     */
    protected function getDatabase()
    {
        $database = $this->option('database');

        return $database ?: $this->laravel['config']['database.default'];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'],

            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production.'],
        ];
    }
}
