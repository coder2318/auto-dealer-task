<?php

namespace App\Services;

use App\Enums\LeadStatusEnum;
use App\Models\User;
use App\Models\V1\Lead;
use App\Repositories\ManagerRepository;

class ManagerService  extends BaseService
{
    public function __construct(ManagerRepository $repository)
    {
        $this->repo = $repository;
        $this->filter_fields = ['status' => ['type' => 'number']];
        $this->relation = ['user'];
    }

    public function getLead(int $id)
    {
        /** @var Lead $lead */
        $lead = $this->repo->getById($id);

        if($lead->user_id)
            abort(403, 'Этот лид ранее был назначен менеджеру');

        $data = [
            'user_id' => User::UserApiGuard()->getAuthIdentifier(),
            'status' => LeadStatusEnum::IN_PROGRESS,
        ];

        return $this->edit($data, $id);
    }
}
