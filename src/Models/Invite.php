<?php

namespace Stats4sd\TeamManagement\Models;

use Stats4sd\TeamManagement\Models\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invite extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = "invites";
    protected $guarded = ['id'];

    protected $casts = [
        'is_confirmed' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('unconfirmed', function (Builder $builder) {
            $builder->where('is_confirmed', false);
        });
    }

    public function confirm(): bool
    {
        $this->is_confirmed = 1;
        $this->save();

        return $this->is_confirmed;
    }

    public function inviter()
    {
        return $this->belongsTo(config('team-management.models.user'), 'inviter_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
