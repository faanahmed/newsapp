<?php

namespace App\Console\Commands;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanupNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleaning up news every day';

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
        $oldDate = Carbon::now()->subDays(14)->endOfDay();
        News::where('created_at', '<=', $oldDate)
            ->delete();

        return 0;
    }
}
