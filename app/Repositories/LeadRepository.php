<?php

namespace App\Repositories;

use App\Models\V1\Lead;

class LeadRepository extends BaseRepository
{
    public function __construct(Lead $lead)
    {
        $this->entity = $lead;
    }
}
