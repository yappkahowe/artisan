<?php

namespace YappKaHowe\Artisan\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\ConnectionResolver;
use Symfony\Component\Console\Input\InputOption;

class TruncateCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'db:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate the database';

    /**
     * The connection resolver instance.
     *
     * @var \Illuminate\Database\ConnectionResolver
     */
    protected $resolver;

    /**
     * Create a new database seed command instance.
     *
     * @param  \Illuminate\Database\ConnectionResolver  $resolver
     * @return void
     */
    public function __construct(ConnectionResolver $resolver)
    {
        parent::__construct();

        $this->resolver = $resolver;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! $this->confirmToProceed()) return;

        $this->resolver->setDefaultConnection($this->getDatabase());

        $this->truncateAllTables();

        $this->info('Truncated all tables successfully.');
    }

    protected function truncateAllTables()
    {
        \Schema::disableForeignKeyConstraints();

        foreach ($this->getTables() as $tableObject) {
            $table = current(get_object_vars($tableObject));

            \DB::table($table)->truncate();
        }

        \Schema::enableForeignKeyConstraints();
    }

    protected function getTables()
    {
        $tables = \DB::select('SHOW TABLES');

        if (($index = array_search('migrations', $tables))) {
            unset($tables[$index]);
        }

        return $tables;
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
