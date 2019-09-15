<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:app ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the application';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('This will install the application API');

        $partners = file_get_contents('resources/partners.json');
        $partners = json_decode($partners);
        
        print_r($partners);
    }

}