<?php

namespace App\Models\V1;

use App\Casts\ArrayStringCast;
use App\Enums\LeadStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property  string $full_name
 * @property  string $status
 * @property  string $note
 * @property  int $user_id
 * @property  array $brand_ids
 * @property  string $phone
 */
class Lead extends Model
{
    use SoftDeletes;

    protected $table = 'leads';

    protected $fillable = [
        'full_name',
        'phone',
        'status',
        'note',
        'user_id',
        'brand_ids',
    ];


    protected $casts = [
        'brand_ids' => ArrayStringCast::class,
    ];

    protected static function booted(): void
    {
        parent::boot();
        static::creating(function ($lead) {
            $lead->status = LeadStatusEnum::NEW;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function brands(): array
    {
        return Brand::query()->whereIn('id', $this->brand_ids)->get()->toArray();
    }

}
