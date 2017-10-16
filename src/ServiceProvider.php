<?php

namespace YappKaHowe\Artisan;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->commands([
            Commands\TruncateCommand::class,
            Commands\ReseedCommand::class,
        ]);
    }
}