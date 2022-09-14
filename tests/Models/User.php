<?php

namespace Stats4sd\TeamManagement\Tests;

use Illuminate\Database\Eloquent\Model;
use Stats4sd\TeamManagement\HasTeamMemberships;

class User extends Model
{
    use HasTeamMemberships;
}

