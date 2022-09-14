<?php

namespace Stats4sd\TeamManagement\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\PermissionManager\app\Models\Role;

class RoleInvite extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'role_invites';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $casts = [
        'is_confirmed' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('unconfirmed', function (Builder $builder) {
            $builder->where('is_confirmed', false);
        });
    }
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */


    public function confirm()
    {
        $this->is_confirmed = 1;
        $this->save();

        return $this->is_confirmed;
    }

    public function getInviteDayAttribute()
    {
        return Carbon::parse($this->created_at)
       ->toDayDateTimeString();
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function inviter()
    {
        return $this->belongsTo(config('team-management.models.user'), 'inviter_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
