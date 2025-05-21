<?php

namespace App\Console\Commands;

use App\Enums\LeadStatusEnum;
use App\Models\V1\Lead;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ChangeLeadStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-lead-status-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change lead status to cancel';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->output->progressStart();
        Lead::query()->where('status', LeadStatusEnum::NEW)->where('created_at', '<=', Carbon::now()->subDay())->get()->map(function ($lead) {
            $lead->status = LeadStatusEnum::CANCELLED;
            $lead->save();
        });
        $this->output->progressFinish();
    }
}
