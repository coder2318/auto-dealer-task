<?php

namespace App\Enums;

enum LeadStatusEnum
{
    const NEW = 'new';
    const IN_PROGRESS = 'in_progress';
    const COMPLETED = 'completed';
    const CANCELLED = 'cancelled';
}
