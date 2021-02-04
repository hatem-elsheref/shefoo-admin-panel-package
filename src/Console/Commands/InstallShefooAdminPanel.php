<?php

namespace Shefoo\Frontend\Dashboard\Console\Commands;

use Illuminate\Console\Command;

class InstallShefooAdminPanel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shefoo:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the package and publish configs and views ..';

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
        $this->info('Installing shefoo admin panel...');

        $this->info('Publishing configurations , translations ,views and assets ...');


        $this->call('vendor:publish', [
            '--provider' => "Shefoo\Frontend\Dashboard\AdminPanelServiceProvider",
            '--tag'=>'all'
        ]);

        $this->info('shefoo admin panel installed successfully');

        return 0;
    }
}
