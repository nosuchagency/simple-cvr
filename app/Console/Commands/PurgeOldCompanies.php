<?php

namespace App\Console\Commands;

use App\Company;
use Illuminate\Console\Command;

class PurgeOldCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'companies:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Purge companies older than three months';

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
        $this->info('Looking for companies older than three months');

        $threeMonthsAgo = now()->subMonths(3);

        $count = Company::query()->whereDate('created_at', '<', $threeMonthsAgo)->count();

        $this->info('Found ' . $count . ' companies older than three months');

        $this->info('Purging ' . $count . ' companies');

        Company::query()->whereDate('created_at', '<', $threeMonthsAgo)->delete();
    }
}
