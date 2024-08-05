<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DeleteOldUsers extends Command
{
    protected $signature = 'users:delete-old';
    protected $description = 'Delete users who registered more than 1 day ago';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $date = Carbon::now()->subDay();
        $deletedCount = User::where('created_at', '<', $date)->delete();

        $this->info("Deleted $deletedCount old users.");
    }
}
