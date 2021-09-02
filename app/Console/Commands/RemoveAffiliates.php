<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Affiliate;

class RemoveAffiliates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:RemoveAffiliates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove affiliates that expired';

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
        Affiliate::where('exp_date', '<', date_create(date('y-m-d h:m:s')))->delete();
        
        return 0;
    }
}
