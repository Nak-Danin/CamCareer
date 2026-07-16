<?php

namespace App\Console\Commands;

use App\Models\Interview;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CancelPastInterviews extends Command
{
    protected $signature = 'interview:cancel-past';
    protected $description = 'Automatically cancel interviews that have passed their scheduled time.';

    public function handle()
    {
        $today = Carbon::today()->toDateString(); // e.g. "2026-07-17"
        $nowTime = Carbon::now()->toTimeString(); // e.g. "03:40:00"

        $updatedCount = Interview::where('status', '!=', 'cancelled')
            ->where(function ($query) use ($today, $nowTime) {
                $query->where('interview_date', '<', $today) // Case 1: Date is in the past
                    ->orWhere(function ($q) use ($today, $nowTime) {
                        $q->where('interview_date', '=', $today) // Case 2: Date is today, but time is past
                            ->where('interview_time', '<', $nowTime);
                    });
            })
            ->update(['status' => 'cancelled']); // Key-value associative array with =>

        $this->info("Successfully cancelled {$updatedCount} past interviews.");
    }
}
