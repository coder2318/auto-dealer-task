<?php

namespace App\Observers;

use App\Enums\LeadStatusEnum;
use App\Jobs\SendMessageTelegramJob;
use App\Models\V1\Lead;

class LeadObserver
{
    /**
     * Handle the Lead "created" event.
     */
    public function created(Lead $lead): void
    {
        SendMessageTelegramJob::dispatch("🆕 Yangi Lid yaratildi 👇 \n 📥 FIO: {$lead->full_name}  \n 📲 Phone: " . $lead->phone);
    }

    /**
     * Handle the Lead "updated" event.
     */
    public function updated(Lead $lead): void
    {
        $status_sticker = match ($lead->status){
            LeadStatusEnum::IN_PROGRESS => '🕔',
            LeadStatusEnum::COMPLETED => '✅',
            LeadStatusEnum::CANCELLED => '❌',
            default => '🆕'
        };
        SendMessageTelegramJob::dispatch("🔄 Lid statusi o'zgardi 👇 \n 📥 FIO: {$lead->full_name}  \n 📲 Phone: {$lead->phone}  \n 🔜 Status to: $status_sticker {$lead->status} \n " .
            " 👨‍💻 Manager: {$lead->user?->name}" );

    }

    /**
     * Handle the Lead "deleted" event.
     */
    public function deleted(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "restored" event.
     */
    public function restored(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "force deleted" event.
     */
    public function forceDeleted(Lead $lead): void
    {
        //
    }
}
