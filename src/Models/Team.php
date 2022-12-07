<?php /** @noinspection PsalmGlobal */

namespace Stats4sd\TeamManagement\Models;


use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stats4sd\TeamManagement\Mail\InviteMember;

class Team extends Model
{
    use CrudTrait;

    protected $table = 'teams';
    protected $guarded = ['id'];

    /**
     * Generate an invitation to join this team for each of the provided email addresses
     * @param array $emails
     */
    public function sendInvites(array $emails): void
    {
        foreach ($emails as $email) {
            $invite = $this->invites()->create([
                'email' => $email,
                'inviter_id' => auth()->id(),
                'token' => Str::random(24),
            ]);

            Mail::to($invite->email)->send(new InviteMember($invite));
        }
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(config('team-management.models.user'), 'team_members')
            ->withPivot('is_admin');
    }

    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(config('team-management.models.user'), 'team_members')
            ->withPivot('is_admin')
            ->wherePivot('is_admin', 1);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(config('team-management.models.user'), 'team_members')
            ->withPivot('is_admin')
            ->wherePivot('is_admin', 0);
    }

    public function invites(): HasMany
    {
        return $this->hasMany(Invite::class);
    }
}
